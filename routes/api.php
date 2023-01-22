<?php

use Illuminate\Support\Facades\Route;


Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
    });

    Route::prefix('category')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CategoryController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
    });

    Route::prefix('lesson')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\LessonController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\LessonController::class, 'show']);
        Route::get('/search/{title}', [\App\Http\Controllers\Api\LessonController::class, 'search']);
        Route::post('/create', [\App\Http\Controllers\Api\LessonController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\LessonController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\LessonController::class, 'destroy']);
    });

    Route::prefix('additional')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\AdditionalController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\AdditionalController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\AdditionalController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\AdditionalController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\AdditionalController::class, 'destroy']);
    });

    Route::prefix('assignment')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\AssignmentController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\AssignmentController::class, 'show']);
        Route::get('/search/{title}', [\App\Http\Controllers\Api\AssignmentController::class, 'search']);
        Route::post('/create', [\App\Http\Controllers\Api\AssignmentController::class, 'create']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\AssignmentController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\AssignmentController::class, 'destroy']);
    });

    Route::prefix('response')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\ResponseController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\ResponseController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\ResponseController::class, 'store']);
        Route::post('/update/{id}', [\App\Http\Controllers\Api\ResponseController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\ResponseController::class, 'destroy']);
    });

    Route::prefix('comment')->group(function (){
        Route::get('/index', [\App\Http\Controllers\Api\CommentController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\Api\CommentController::class, 'show']);
        Route::post('/create', [\App\Http\Controllers\Api\CommentController::class, 'create']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\Api\CommentController::class, 'destroy']);
    });

    Route::post('/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
});


