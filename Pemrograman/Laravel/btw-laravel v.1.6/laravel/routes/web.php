<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentManager;
use App\Http\Controllers\MentorManager;
use App\Http\Controllers\ClassroomManager;
use App\Http\Controllers\LessonManager;
use App\Http\Controllers\ScoreManager;
use Illuminate\Support\Facades\Route;

// === PUBLIC PAGE ===

Route::get('/', function () {
    return view('welcome');
});

Route::get('/401', function () {
    return view('401');
});

// === LOGIN & REGISTER ===

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// === PROTECTED BY AUTH ===

// Admin

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth');
    // Manage Student
    Route::get('/student/index', [StudentManager::class, 'student_index'])->middleware('auth');
    Route::get('/student/registering', [StudentManager::class, 'student_registering'])->middleware('auth');
    Route::get('/student/form/{id}', [StudentManager::class, 'student_form'])->middleware('auth');
    Route::post('/student/create', [StudentManager::class, 'student_update'])->middleware('auth');
    // Manage Mentor
    Route::get('/mentor/index', [MentorManager::class, 'mentor_index'])->middleware('auth');
    Route::get('/mentor/registering', [MentorManager::class, 'mentor_registering'])->middleware('auth');
    Route::get('/mentor/form/{id}', [MentorManager::class, 'mentor_form'])->middleware('auth');
    Route::post('/mentor/create', [MentorManager::class, 'mentor_create'])->middleware('auth');
    // Manage Classroom
    Route::get('/classroom/index', [ClassroomManager::class, 'classroom_index'])->middleware('auth');
    Route::get('/classroom/form', [ClassroomManager::class, 'classroom_form'])->middleware('auth');
    Route::post('/classroom/create', [ClassroomManager::class, 'classroom_create'])->middleware('auth');
    Route::get('/classroom/{id}/lock', [ClassroomManager::class, 'classroom_lock'])->middleware('auth');
    Route::get('/classroom/{id}/deactivate', [ClassroomManager::class, 'classroom_deactivate'])->middleware('auth');
    // Manage Lesson
    Route::get('/classroom/{classroom_id}/lesson', [LessonManager::class, 'lesson_index'])->middleware('auth');
    Route::get('/classroom/{classroom_id}/lesson/form', [LessonManager::class, 'lesson_form'])->middleware('auth');
    Route::post('/classroom/{classroom_id}/lesson/create', [LessonManager::class, 'lesson_create'])->middleware('auth');
    // Manage Score
    Route::get('/classroom/{classroom_id}/lesson/{id}/score', [ScoreManager::class, 'score_index'])->middleware('auth');
    Route::get('/classroom/{classroom_id}/lesson/{id}/score/form', [ScoreManager::class, 'score_form'])->middleware('auth');
    Route::post('/classroom/{classroom_id}/lesson/{id}/score/form', [ScoreManager::class, 'score_create'])->middleware('auth');
});

// Student

Route::prefix('student')->group(function () {

    Route::get('/dashboard', [StudentController::class, 'dashboard'])->middleware('auth');
    Route::get('/score', [StudentController::class, 'score_index'])->middleware('auth');
    Route::get('/edit', [StudentController::class, 'student_edit_form'])->middleware('auth');
    Route::post('/edit/save', [StudentController::class, 'student_edit_save'])->middleware('auth');
});

// Mentor

Route::prefix('mentor')->group(function () {

    Route::get('/dashboard', [MentorController::class, 'dashboard'])->middleware('auth');
    Route::get('/classroom', [MentorController::class, 'classroom_index'])->middleware('auth');
    Route::get('/edit', [MentorController::class, 'mentor_edit_form'])->middleware('auth');
    Route::post('/edit/save', [MentorController::class, 'mentor_edit_save'])->middleware('auth');
    // Manage Lesson
    Route::get('/classroom/{classroom_id}/lesson', [MentorController::class, 'lesson_index'])->middleware('auth');
    Route::get('/classroom/{classroom_id}/lesson/form', [MentorController::class, 'lesson_form'])->middleware('auth');
    Route::post('/classroom/{classroon_id}/lesson/create', [MentorController::class, 'lesson_create'])->middleware('auth');
    // Manage Score
    Route::get('/classroom/{classroom_id}/lesson/{id}/score', [MentorController::class, 'score_index'])->middleware('auth');
    Route::get('/classroom/{classroom_id}/lesson/{id}/score/form', [MentorController::class, 'score_form'])->middleware('auth');
    Route::post('/classroom/{classroom_id}/lesson/{id}/score/form', [MentorController::class, 'score_create'])->middleware('auth');
});
