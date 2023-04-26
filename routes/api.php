<?php

use Illuminate\Support\Facades\Route;


Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);

    Route::prefix('users')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::get('/show/{user}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
        Route::post('/update/{user}', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::delete('/delete/{user}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
    });

    Route::prefix('categories')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('/show/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CategoryController::class, 'create']);
        Route::post('/update/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
        Route::delete('/delete/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
    });

    Route::prefix('lessons')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\LessonController::class, 'index']);
        Route::get('/show/{lesson}', [\App\Http\Controllers\Api\LessonController::class, 'show']);
        Route::get('/search/{title}', [\App\Http\Controllers\Api\LessonController::class, 'search']);
        Route::post('/create', [\App\Http\Controllers\Api\LessonController::class, 'create']);
        Route::post('/update/{lesson}', [\App\Http\Controllers\Api\LessonController::class, 'update']);
        Route::delete('/delete/{lesson}', [\App\Http\Controllers\Api\LessonController::class, 'destroy']);
    });

    Route::prefix('additionals')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\AdditionalController::class, 'index']);
        Route::get('/show/{additional}', [\App\Http\Controllers\Api\AdditionalController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\AdditionalController::class, 'create']);
        Route::post('/update/{additional}', [\App\Http\Controllers\Api\AdditionalController::class, 'update']);
        Route::delete('/delete/{additional}', [\App\Http\Controllers\Api\AdditionalController::class, 'destroy']);
    });

    Route::prefix('assignments')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\AssignmentController::class, 'index']);
        Route::get('/show/{assignment}', [\App\Http\Controllers\Api\AssignmentController::class, 'show']);
        Route::get('/search/{title}', [\App\Http\Controllers\Api\AssignmentController::class, 'search']);
        Route::post('/create', [\App\Http\Controllers\Api\AssignmentController::class, 'create']);
        Route::post('/update/{assignment}', [\App\Http\Controllers\Api\AssignmentController::class, 'update']);
        Route::delete('/delete/{assignment}', [\App\Http\Controllers\Api\AssignmentController::class, 'destroy']);
    });

    Route::prefix('responses')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\ResponseController::class, 'index']);
        Route::get('/show/{response}', [\App\Http\Controllers\Api\ResponseController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ResponseController::class, 'store']);
        Route::post('/update/{response}', [\App\Http\Controllers\Api\ResponseController::class, 'update']);
        Route::delete('/delete/{response}', [\App\Http\Controllers\Api\ResponseController::class, 'destroy']);
    });

    Route::prefix('comments')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\CommentController::class, 'index']);
        Route::get('/show/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CommentController::class, 'create']);
        Route::delete('/delete/{comment}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
    });

    Route::post('/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
});


