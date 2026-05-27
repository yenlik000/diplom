<?php

use App\Core\Router;
use App\Core\Request;
use App\Controllers\AuthController;
use App\Controllers\SocialAuthController;
use App\Controllers\UserController;
use App\Controllers\GroupController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Controllers\LessonController;
use App\Controllers\EnrollmentController;
use App\Controllers\ProgressController;
use App\Controllers\HomeworkController;
use App\Controllers\AdminController;
use App\Controllers\TeacherController;
use App\Controllers\ReviewController;
use App\Controllers\CommentController;
use App\Controllers\MessageController;
use App\Controllers\ProfileController;
use App\Controllers\AiController;
use App\Controllers\TicketController;
use App\Controllers\UploadController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\TeacherMiddleware;
use App\Middleware\StudentMiddleware;

$router  = new Router();
$request = new Request();

// ── Auth ─────────────────────────────────────────────────────
$router->post('/login',          [AuthController::class,       'login'],    );
$router->get( '/me',             [AuthController::class,       'me'],       [AuthMiddleware::class]);
$router->post('/auth/login',     [AuthController::class,       'login'],    );
$router->get( '/auth/me',        [AuthController::class,       'me'],       [AuthMiddleware::class]);
$router->post('/auth/google',    [SocialAuthController::class, 'google'],   );
$router->post('/auth/facebook',  [SocialAuthController::class, 'facebook'], );
$router->post('/auth/register',  [SocialAuthController::class, 'register'], );

// ── User management (admin) ───────────────────────────────────
// New clean endpoint
$router->post('/users/create', [UserController::class, 'create'], [AdminMiddleware::class]);

// ── Groups (admin) ────────────────────────────────────────────
$router->get(   '/groups',      [GroupController::class, 'index'],   [AdminMiddleware::class]);
$router->post(  '/groups',      [GroupController::class, 'store'],   [AdminMiddleware::class]);
$router->put(   '/groups/{id}', [GroupController::class, 'update'],  [AdminMiddleware::class]);
$router->delete('/groups/{id}', [GroupController::class, 'destroy'], [AdminMiddleware::class]);

// ── Courses (public) ──────────────────────────────────────────
$router->get('/courses',      [CourseController::class, 'index']);
$router->get('/courses/{id}', [CourseController::class, 'show']);

// ── Courses (teacher/admin) ───────────────────────────────────
$router->post(  '/courses',                    [CourseController::class, 'store'],       [TeacherMiddleware::class]);
$router->put(   '/courses/{id}',              [CourseController::class, 'update'],      [TeacherMiddleware::class]);
$router->delete('/courses/{id}',              [CourseController::class, 'destroy'],     [TeacherMiddleware::class]);
$router->post(  '/courses/{id}/upload-cover', [CourseController::class, 'uploadCover'], [TeacherMiddleware::class]);

// ── Modules (teacher/admin) ───────────────────────────────────
$router->post(  '/courses/{courseId}/modules', [ModuleController::class, 'store'],   [TeacherMiddleware::class]);
$router->put(   '/modules/{id}',               [ModuleController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/modules/{id}',               [ModuleController::class, 'destroy'], [TeacherMiddleware::class]);

// ── Lessons ───────────────────────────────────────────────────
$router->get(   '/lessons/{id}',               [LessonController::class, 'show'],    [AuthMiddleware::class]);
$router->post(  '/modules/{moduleId}/lessons', [LessonController::class, 'store'],   [TeacherMiddleware::class]);
$router->put(   '/lessons/{id}',               [LessonController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/lessons/{id}',               [LessonController::class, 'destroy'], [TeacherMiddleware::class]);
$router->post(  '/lessons/{id}/upload-video',  [UploadController::class, 'uploadVideo'], [TeacherMiddleware::class]);
$router->post(  '/lessons/{id}/upload-audio',  [UploadController::class, 'uploadAudio'], [TeacherMiddleware::class]);

// ── Enrollments ───────────────────────────────────────────────
$router->get( '/enrollments', [EnrollmentController::class, 'index'], [AuthMiddleware::class]);
$router->post('/enrollments', [EnrollmentController::class, 'store'], [AuthMiddleware::class]);

// ── Progress ──────────────────────────────────────────────────
$router->get( '/progress/courses/{courseId}',          [ProgressController::class, 'course'],   [AuthMiddleware::class]);
$router->post('/progress/lessons/{lessonId}/complete', [ProgressController::class, 'complete'], [AuthMiddleware::class]);

// ── Homework ──────────────────────────────────────────────────
$router->get(   '/homeworks/{id}',               [HomeworkController::class, 'show'],    [AuthMiddleware::class]);
$router->post(  '/homeworks/{id}/submit',        [HomeworkController::class, 'submit'],  [AuthMiddleware::class]);
$router->post(  '/lessons/{lessonId}/homeworks', [HomeworkController::class, 'create'],  [TeacherMiddleware::class]);
$router->get(   '/homeworks/{id}/edit',          [HomeworkController::class, 'edit'],    [TeacherMiddleware::class]);
$router->put(   '/homeworks/{id}',               [HomeworkController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/homeworks/{id}',               [HomeworkController::class, 'destroy'], [TeacherMiddleware::class]);

// ── Teacher ───────────────────────────────────────────────────
$router->get('/teacher/courses',        [TeacherController::class, 'myCourses'],  [TeacherMiddleware::class]);
$router->get('/teacher/courses/{id}',   [TeacherController::class, 'getCourse'],  [TeacherMiddleware::class]);
$router->get('/teacher/efficiency',  [TeacherController::class, 'efficiency'],   [TeacherMiddleware::class]);
$router->get('/teacher/stats',       [TeacherController::class, 'stats'],        [TeacherMiddleware::class]);
$router->get(  '/teacher/submissions',           [TeacherController::class, 'submissions'],  [TeacherMiddleware::class]);
$router->get(  '/teacher/submissions/{id}',      [TeacherController::class, 'submissionDetail'], [TeacherMiddleware::class]);
$router->patch('/teacher/submissions/{id}/grade',[TeacherController::class, 'grade'],           [TeacherMiddleware::class]);
$router->get(  '/teacher/students',              [TeacherController::class, 'students'],        [TeacherMiddleware::class]);

// ── Reviews (public) ─────────────────────────────────────────
$router->get(  '/reviews',           [ReviewController::class, 'index']);
$router->post( '/reviews',           [ReviewController::class, 'store']);
$router->patch('/reviews/{id}/vote', [ReviewController::class, 'vote']);

// ── Comments (public read, auth write) ────────────────────────
$router->get( '/comments',  [CommentController::class, 'index']);
$router->post('/comments',  [CommentController::class, 'store'], [AuthMiddleware::class]);

// ── Profile ───────────────────────────────────────────────────
$router->get( '/profile',          [ProfileController::class, 'show'],           [AuthMiddleware::class]);
$router->put( '/profile',          [ProfileController::class, 'update'],         [AuthMiddleware::class]);
$router->post('/profile/password', [ProfileController::class, 'changePassword'], [AuthMiddleware::class]);
$router->put( '/profile/privacy',  [ProfileController::class, 'updatePrivacy'],  [AuthMiddleware::class]);
$router->post('/profile/avatar',   [ProfileController::class, 'uploadAvatar'],   [AuthMiddleware::class]);

// ── Messages ──────────────────────────────────────────────────
$router->get( '/messages/contacts',      [MessageController::class, 'contacts'],    [AuthMiddleware::class]);
$router->get( '/messages',               [MessageController::class, 'index'],       [AuthMiddleware::class]);
$router->post('/messages',               [MessageController::class, 'store'],       [AuthMiddleware::class]);
$router->post('/messages/upload-image',  [MessageController::class, 'uploadImage'], [AuthMiddleware::class]);

// ── Support Tickets ───────────────────────────────────────────
$router->get(  '/tickets',                  [TicketController::class, 'index'],        [TeacherMiddleware::class]);
$router->get(  '/tickets/{id}',             [TicketController::class, 'show'],         [TeacherMiddleware::class]);
$router->post( '/tickets/{id}/messages',    [TicketController::class, 'addMessage'],   [TeacherMiddleware::class]);
$router->patch('/tickets/{id}/status',      [TicketController::class, 'updateStatus'], [TeacherMiddleware::class]);

// ── AI Assistant ──────────────────────────────────────────────
$router->post('/ai/chat', [AiController::class, 'chat'], [AuthMiddleware::class]);

// ── Admin ─────────────────────────────────────────────────────
$router->get(   '/admin/users',       [AdminController::class, 'users'],      [AdminMiddleware::class]);
$router->post(  '/admin/users',       [AdminController::class, 'createUser'], [AdminMiddleware::class]);
$router->delete('/admin/users/{id}',  [AdminController::class, 'deleteUser'], [AdminMiddleware::class]);
$router->get(   '/admin/teachers',    [AdminController::class, 'teachers'],   [AdminMiddleware::class]);
$router->get( '/admin/stats',    [AdminController::class, 'stats'],      [AdminMiddleware::class]);

$router->dispatch($request);
