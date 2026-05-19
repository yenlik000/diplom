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
$router->post(  '/courses',      [CourseController::class, 'store'],   [TeacherMiddleware::class]);
$router->put(   '/courses/{id}', [CourseController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/courses/{id}', [CourseController::class, 'destroy'], [TeacherMiddleware::class]);

// ── Modules (teacher/admin) ───────────────────────────────────
$router->post(  '/courses/{courseId}/modules', [ModuleController::class, 'store'],   [TeacherMiddleware::class]);
$router->put(   '/modules/{id}',               [ModuleController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/modules/{id}',               [ModuleController::class, 'destroy'], [TeacherMiddleware::class]);

// ── Lessons ───────────────────────────────────────────────────
$router->get(   '/lessons/{id}',               [LessonController::class, 'show'],    [AuthMiddleware::class]);
$router->post(  '/modules/{moduleId}/lessons', [LessonController::class, 'store'],   [TeacherMiddleware::class]);
$router->put(   '/lessons/{id}',               [LessonController::class, 'update'],  [TeacherMiddleware::class]);
$router->delete('/lessons/{id}',               [LessonController::class, 'destroy'], [TeacherMiddleware::class]);

// ── Enrollments ───────────────────────────────────────────────
$router->get( '/enrollments', [EnrollmentController::class, 'index'], [AuthMiddleware::class]);
$router->post('/enrollments', [EnrollmentController::class, 'store'], [AuthMiddleware::class]);

// ── Progress ──────────────────────────────────────────────────
$router->get( '/progress/courses/{courseId}',          [ProgressController::class, 'course'],   [AuthMiddleware::class]);
$router->post('/progress/lessons/{lessonId}/complete', [ProgressController::class, 'complete'], [AuthMiddleware::class]);

// ── Homework ──────────────────────────────────────────────────
$router->get( '/homeworks/{id}',        [HomeworkController::class, 'show'],   [AuthMiddleware::class]);
$router->post('/homeworks/{id}/submit', [HomeworkController::class, 'submit'], [AuthMiddleware::class]);

// ── Teacher ───────────────────────────────────────────────────
$router->get('/teacher/courses', [TeacherController::class, 'myCourses'], [TeacherMiddleware::class]);
$router->get('/teacher/stats',   [TeacherController::class, 'stats'],     [TeacherMiddleware::class]);

// ── Admin ─────────────────────────────────────────────────────
$router->get( '/admin/users', [AdminController::class, 'users'],      [AdminMiddleware::class]);
$router->post('/admin/users', [AdminController::class, 'createUser'], [AdminMiddleware::class]);
$router->get( '/admin/stats', [AdminController::class, 'stats'],      [AdminMiddleware::class]);

$router->dispatch($request);
