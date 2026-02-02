<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('landing');
});

Route::middleware('auth.check')->group(function () {
Route::get('/profile', [ProfileController::class, 'show']);
Route::post('/profile', [ProfileController::class, 'update']);
Route::post('/profile/image/remove', [ProfileController::class, 'removeImage']);
});

Route::middleware('auth.check')->group(function () {
Route::resource('tasks', TaskController::class);
Route::post('/tasks/{id}/done', [TaskController::class, 'done']);
Route::post('/tasks/{id}/undone', [TaskController::class, 'undone']);
});
