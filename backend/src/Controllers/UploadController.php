<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\MinioStorage;
use App\Core\Request;
use App\Core\Response;

class UploadController
{
    private const ALLOWED_VIDEO = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];
    private const ALLOWED_AUDIO = ['audio/mpeg', 'audio/mp3', 'audio/ogg', 'audio/wav', 'audio/m4a', 'audio/x-m4a'];
    private const MAX_VIDEO     = 512 * 1024 * 1024; // 512 MB
    private const MAX_AUDIO     =  50 * 1024 * 1024; //  50 MB

    // POST /lessons/{id}/upload-video   (multipart, field: file)
    public function uploadVideo(Request $request): void
    {
        $lessonId = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];

        $this->assertLessonOwnership($lessonId, $userId, $role);

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            Response::error($this->uploadErrMsg($_FILES['file']['error'] ?? -1), 422);
        }

        $file = $_FILES['file'];

        if (!in_array($file['type'], self::ALLOWED_VIDEO, true)) {
            Response::error('Only MP4, WebM, OGG or MOV video files are allowed', 422);
        }
        if ($file['size'] > self::MAX_VIDEO) {
            Response::error('Video file must be under 512 MB', 422);
        }

        $url = $this->saveToMinio($file, $lessonId, 'video');

        DB::query('UPDATE lessons SET video_url = ? WHERE id = ?', [$url, $lessonId]);

        Response::success(['url' => $url], 'Video uploaded');
    }

    // POST /lessons/{id}/upload-audio   (multipart, field: file)
    public function uploadAudio(Request $request): void
    {
        $lessonId = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];

        $this->assertLessonOwnership($lessonId, $userId, $role);

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            Response::error($this->uploadErrMsg($_FILES['file']['error'] ?? -1), 422);
        }

        $file = $_FILES['file'];

        if (!in_array($file['type'], self::ALLOWED_AUDIO, true)) {
            Response::error('Only MP3, OGG, WAV or M4A audio files are allowed', 422);
        }
        if ($file['size'] > self::MAX_AUDIO) {
            Response::error('Audio file must be under 50 MB', 422);
        }

        $url = $this->save($file, $lessonId, 'audio');

        DB::query('UPDATE lessons SET audio_url = ? WHERE id = ?', [$url, $lessonId]);

        Response::success(['url' => $url], 'Audio uploaded');
    }

    private function saveToMinio(array $file, int $lessonId, string $type): string
    {
        $ext       = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $objectKey = "{$type}_{$lessonId}_" . time() . '.' . $ext;

        $minio = new MinioStorage();
        try {
            return $minio->upload($file['tmp_name'], $objectKey, $file['type']);
        } catch (\RuntimeException $e) {
            Response::error('Storage upload failed: ' . $e->getMessage(), 500);
        }
    }

    private function save(array $file, int $lessonId, string $type): string
    {
        $ext       = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename  = "{$type}_{$lessonId}_" . time() . '.' . $ext;
        $dir       = BASE_PATH . '/public/uploads/lessons/';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $dir . $filename)) {
            Response::error('Failed to save file', 500);
        }

        return '/uploads/lessons/' . $filename;
    }

    private function assertLessonOwnership(int $lessonId, int $userId, string $role): void
    {
        if ($role === 'admin') return;
        $row = DB::query(
            'SELECT c.teacher_id
             FROM lessons l
             JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id
             WHERE l.id = ?',
            [$lessonId]
        )->fetch();
        if (!$row || (int) $row['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
        }
    }

    private function uploadErrMsg(int $err): string
    {
        return match($err) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'File exceeds maximum allowed size',
            UPLOAD_ERR_PARTIAL   => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE   => 'No file was uploaded',
            default              => 'Upload failed',
        };
    }
}
