<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TeamController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('teams', TeamController::class);

    Route::post('tasks/{task}/comments', [CommentController::class, 'store']);
    Route::get('tasks/{task}/comments', [CommentController::class, 'index']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

    Route::post('teams/{team}/users', [TeamController::class, 'addUser']);
    Route::delete('teams/{team}/users/{user}', [TeamController::class, 'removeUser']);
});
