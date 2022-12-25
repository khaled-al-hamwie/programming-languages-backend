<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// public
Route::post('/expert/register', [ExpertController::class, 'store']);
Route::post('/expert/login', [ExpertController::class, 'login']);

Route::post('/user/register', [UserController::class, 'store']);
Route::post('/user/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // only expert
    Route::patch('/expert', [ExpertController::class, 'update']);
    Route::delete('/expert', [ExpertController::class, 'destroy']);
    Route::post('/expert/logout', [ExpertController::class, 'logout']);

    Route::get('/experience', [ExperienceController::class, 'show']);
    Route::post('/experience', [ExperienceController::class, 'store']);
    Route::patch('/experience/{id}', [ExperienceController::class, 'update']);
    Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);
    // user and expert
    Route::get('/expert', [ExpertController::class, 'index']);
    Route::get('/expert/{id}', [ExpertController::class, 'show']);

    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);

    // only user
    Route::post('/user/logout',   [UserController::class, 'logout']);
});
