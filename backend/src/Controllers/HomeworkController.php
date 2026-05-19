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

        $questions = DB::query(
            'SELECT id, question_text, question_type, order_num
             FROM homework_questions WHERE homework_id = ? ORDER BY order_num',
            [$id]
        )->fetchAll();

        foreach ($questions as &$q) {
            if ($q['question_type'] === 'multiple_choice') {
                $q['options'] = DB::query(
                    'SELECT id, option_text FROM homework_options WHERE question_id = ?',
                    [$q['id']]
                )->fetchAll();
            }
        }

        $submission = DB::query(
            'SELECT id, submitted_at, score FROM homework_submissions
             WHERE user_id = ? AND homework_id = ?',
            [$userId, $id]
        )->fetch() ?: null;

        $homework['questions']  = $questions;
        $homework['submission'] = $submission;
        Response::success($homework);
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

        Response::success(['score' => $score], 'Homework submitted', 201);
    }
}
