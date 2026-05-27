<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class HomeworkController
{
    // GET /homeworks/{id}
    public function show(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];

        $homework = DB::query('SELECT * FROM homeworks WHERE id = ?', [$id])->fetch();
        if (!$homework) {
            Response::error('Homework not found', 404);
        }

        $submission = DB::query(
            'SELECT id, submitted_at, score FROM homework_submissions
             WHERE user_id = ? AND homework_id = ?',
            [$userId, $id]
        )->fetch() ?: null;

        $questions = DB::query(
            'SELECT id, question_text, question_type, order_num
             FROM homework_questions WHERE homework_id = ? ORDER BY order_num',
            [$id]
        )->fetchAll();

        foreach ($questions as &$q) {
            if ($q['question_type'] === 'multiple_choice') {
                // Include is_correct only after the student has submitted
                if ($submission) {
                    $q['options'] = DB::query(
                        'SELECT id, option_text, is_correct FROM homework_options WHERE question_id = ?',
                        [$q['id']]
                    )->fetchAll();
                } else {
                    $q['options'] = DB::query(
                        'SELECT id, option_text FROM homework_options WHERE question_id = ?',
                        [$q['id']]
                    )->fetchAll();
                }
            }
        }

        $homework['questions']  = $questions;
        $homework['submission'] = $submission;
        Response::success($homework);
    }

    // POST /lessons/{lessonId}/homeworks  — teacher creates a quiz
    public function create(Request $request): void
    {
        $lessonId  = (int) $request->params['lessonId'];
        $title     = trim($request->input('title', ''));
        $questions = $request->input('questions', []);

        if (!$title) { Response::error('title is required', 422); return; }
        if (empty($questions) || !is_array($questions)) {
            Response::error('questions array is required', 422); return;
        }

        $lesson = DB::query('SELECT id FROM lessons WHERE id = ?', [$lessonId])->fetch();
        if (!$lesson) { Response::error('Lesson not found', 404); return; }

        $existing = DB::query('SELECT id FROM homeworks WHERE lesson_id = ?', [$lessonId])->fetch();
        if ($existing) { Response::error('A quiz already exists for this lesson', 409); return; }

        $hw   = DB::query(
            'INSERT INTO homeworks (lesson_id, title) VALUES (?, ?) RETURNING id',
            [$lessonId, $title]
        )->fetch();
        $hwId = (int) $hw['id'];

        $this->saveQuestions($hwId, $questions);
        Response::success(['id' => $hwId], 'Quiz created', 201);
    }

    // GET /homeworks/{id}/edit  — teacher fetches quiz with is_correct
    public function edit(Request $request): void
    {
        $id = (int) $request->params['id'];

        $homework = DB::query('SELECT * FROM homeworks WHERE id = ?', [$id])->fetch();
        if (!$homework) { Response::error('Quiz not found', 404); return; }

        $questions = DB::query(
            'SELECT id, question_text, question_type, order_num
             FROM homework_questions WHERE homework_id = ? ORDER BY order_num',
            [$id]
        )->fetchAll();

        foreach ($questions as &$q) {
            $q['options'] = DB::query(
                'SELECT id, option_text, is_correct
                 FROM homework_options WHERE question_id = ?',
                [$q['id']]
            )->fetchAll();
        }

        $homework['questions'] = $questions;
        Response::success($homework);
    }

    // PUT /homeworks/{id}  — teacher replaces quiz questions/options
    public function update(Request $request): void
    {
        $id        = (int) $request->params['id'];
        $title     = trim($request->input('title', ''));
        $questions = $request->input('questions', []);

        if (!$title) { Response::error('title is required', 422); return; }

        $homework = DB::query('SELECT id FROM homeworks WHERE id = ?', [$id])->fetch();
        if (!$homework) { Response::error('Quiz not found', 404); return; }

        DB::query('UPDATE homeworks SET title = ? WHERE id = ?', [$title, $id]);
        // Cascade deletes options via FK
        DB::query('DELETE FROM homework_questions WHERE homework_id = ?', [$id]);
        $this->saveQuestions($id, $questions);

        Response::success(null, 'Quiz updated');
    }

    // DELETE /homeworks/{id}
    public function destroy(Request $request): void
    {
        $id = (int) $request->params['id'];

        $homework = DB::query('SELECT id FROM homeworks WHERE id = ?', [$id])->fetch();
        if (!$homework) { Response::error('Quiz not found', 404); return; }

        // Cascade handles questions, options, submissions, answers
        DB::query('DELETE FROM homeworks WHERE id = ?', [$id]);
        Response::success(null, 'Quiz deleted');
    }

    private function saveQuestions(int $hwId, array $questions): void
    {
        foreach ($questions as $idx => $q) {
            $qText = trim($q['question_text'] ?? '');
            $qType = $q['question_type'] ?? 'multiple_choice';
            $order = isset($q['order_num']) ? (int) $q['order_num'] : $idx + 1;
            if (!$qText) continue;

            $qRow = DB::query(
                'INSERT INTO homework_questions (homework_id, question_text, question_type, order_num)
                 VALUES (?, ?, ?, ?) RETURNING id',
                [$hwId, $qText, $qType, $order]
            )->fetch();
            $qId = (int) $qRow['id'];

            if ($qType === 'multiple_choice' && !empty($q['options'])) {
                foreach ($q['options'] as $opt) {
                    $optText   = trim($opt['option_text'] ?? '');
                    $isCorrect = !empty($opt['is_correct']) ? 'true' : 'false';
                    if (!$optText) continue;
                    DB::query(
                        'INSERT INTO homework_options (question_id, option_text, is_correct) VALUES (?, ?, ?)',
                        [$qId, $optText, $isCorrect]
                    );
                }
            }
        }
    }

    // POST /homeworks/{id}/submit
    public function submit(Request $request): void
    {
        $homeworkId = (int) $request->params['id'];
        $userId     = (int) $request->params['_user_id'];
        $answers    = $request->input('answers', []);

        if (empty($answers) || !is_array($answers)) {
            Response::error('answers array is required');
        }

        $existing = DB::query(
            'SELECT id FROM homework_submissions WHERE user_id = ? AND homework_id = ?',
            [$userId, $homeworkId]
        )->fetch();

        if ($existing) {
            Response::error('Homework already submitted', 409);
        }

        DB::query(
            'INSERT INTO homework_submissions (user_id, homework_id) VALUES (?, ?)',
            [$userId, $homeworkId]
        );

        $submissionId = (int) DB::query('SELECT lastval()')->fetchColumn();
        $correct      = 0;
        $mcTotal      = 0;

        foreach ($answers as $answer) {
            $questionId       = (int) ($answer['question_id'] ?? 0);
            $answerText       = $answer['answer_text'] ?? null;
            $selectedOptionId = isset($answer['selected_option_id'])
                ? (int) $answer['selected_option_id']
                : null;

            $question = DB::query(
                'SELECT question_type FROM homework_questions WHERE id = ? AND homework_id = ?',
                [$questionId, $homeworkId]
            )->fetch();

            if (!$question) {
                continue;
            }

            $isCorrect = null;
            if ($question['question_type'] === 'multiple_choice' && $selectedOptionId) {
                $option    = DB::query(
                    'SELECT is_correct FROM homework_options WHERE id = ? AND question_id = ?',
                    [$selectedOptionId, $questionId]
                )->fetch();
                $isCorrect = $option && $option['is_correct'];
                $mcTotal++;
                if ($isCorrect) {
                    $correct++;
                }
            }

            DB::query(
                'INSERT INTO homework_answers
                 (submission_id, question_id, answer_text, selected_option_id, is_correct)
                 VALUES (?, ?, ?, ?, ?)',
                [
                    $submissionId,
                    $questionId,
                    $answerText,
                    $selectedOptionId,
                    $isCorrect === null ? null : ($isCorrect ? 'true' : 'false'),
                ]
            );
        }

        $score = $mcTotal > 0 ? round($correct / $mcTotal * 100, 2) : null;

        if ($score !== null) {
            DB::query(
                'UPDATE homework_submissions SET score = ? WHERE id = ?',
                [$score, $submissionId]
            );
        }

        // Return the correct option ID per question so the frontend can show the review screen
        $allQuestions = DB::query(
            'SELECT id FROM homework_questions WHERE homework_id = ?',
            [$homeworkId]
        )->fetchAll();

        $correctOptions = [];
        foreach ($allQuestions as $q) {
            $qid = (int) $q['id'];
            $opt = DB::query(
                'SELECT id FROM homework_options WHERE question_id = ? AND is_correct = TRUE LIMIT 1',
                [$qid]
            )->fetch();
            if ($opt) {
                $correctOptions[$qid] = (int) $opt['id'];
            }
        }

        Response::success(['score' => $score, 'correct_options' => $correctOptions], 'Homework submitted', 201);
    }
}
