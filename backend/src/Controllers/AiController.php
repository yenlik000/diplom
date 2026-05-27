<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class AiController
{
    // POST /ai/chat
    public function chat(Request $request): void
    {
        $lessonId = (int) $request->input('lesson_id', 0);
        $message  = trim($request->input('message', ''));
        $history  = $request->input('history', []);

        if (!$message) {
            Response::error('message is required', 422);
        }

        // Load lesson context
        $lesson = $lessonId
            ? DB::query(
                'SELECT l.title, l.text_content, c.title AS course_title, c.subject
                 FROM lessons l
                 JOIN modules m ON m.id = l.module_id
                 JOIN courses c ON c.id = m.course_id
                 WHERE l.id = ?',
                [$lessonId]
              )->fetch()
            : null;

        $apiKey = $_ENV['ANTHROPIC_API_KEY'] ?? getenv('ANTHROPIC_API_KEY') ?? '';

        if (!$apiKey) {
            // Friendly fallback when no API key is configured
            Response::success([
                'reply' => "I'm the Bridge AI Assistant! To enable real AI responses, please set the ANTHROPIC_API_KEY environment variable. For now, I can confirm your question was: \"{$message}\"",
            ]);
        }

        // Build system prompt with lesson context
        $subject = $lesson['subject'] ?? 'this course';
        $lessonTitle = $lesson['title'] ?? 'the current lesson';
        $lessonNotes = $lesson['text_content']
            ? "\n\nLesson notes:\n" . strip_tags(substr($lesson['text_content'], 0, 1500))
            : '';

        $systemPrompt = "You are Bridge AI Assistant, an expert tutor for the subject: {$subject}. "
            . "The student is currently studying: \"{$lessonTitle}\"."
            . $lessonNotes
            . "\n\nHelp the student understand the material. Be concise, friendly, and pedagogically sound. "
            . "When appropriate, provide examples. Use plain text — no markdown headers, but you may use bullet points sparingly.";

        // Build messages array for Anthropic API
        $messages = [];
        foreach (array_slice($history, -10) as $h) {
            if (isset($h['role'], $h['content']) && in_array($h['role'], ['user', 'assistant'])) {
                $messages[] = ['role' => $h['role'], 'content' => (string) $h['content']];
            }
        }
        $messages[] = ['role' => 'user', 'content' => $message];

        // Anthropic requires: first message must be user, no consecutive same roles
        while (!empty($messages) && $messages[0]['role'] !== 'user') {
            array_shift($messages);
        }

        $payload = json_encode([
            'model'      => 'claude-haiku-4-5-20251001',
            'max_tokens' => 512,
            'system'     => $systemPrompt,
            'messages'   => $messages,
        ]);

        $ch = curl_init('https://api.anthropic.com/v1/messages');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'x-api-key: ' . $apiKey,
                'anthropic-version: 2023-06-01',
            ],
            CURLOPT_TIMEOUT        => 30,
        ]);

        $raw      = curl_exec($ch);
        $curlErr  = curl_error($ch);
        $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($curlErr) {
            Response::error('AI service connection failed: ' . $curlErr, 502);
        }

        $data = json_decode($raw, true);

        if ($code !== 200) {
            $errMsg = $data['error']['message'] ?? 'AI service unavailable.';
            Response::error($errMsg, 502);
        }

        $reply = $data['content'][0]['text'] ?? 'Sorry, I could not generate a response.';

        Response::success(['reply' => $reply]);
    }
}
