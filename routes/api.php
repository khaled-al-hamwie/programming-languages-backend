<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// public
Route::post('/expert', [ExpertController::class, 'store']);
Route::post('/login_expert', [ExpertController::class, 'login']);

Route::post('/create_user', [UserController::class, 'store']);
Route::post('/login_user', [UserController::class, 'login']);

// only expert
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/expert/{id}', [ExpertController::class, 'show']);
    Route::patch('/expert', [ExpertController::class, 'update']);
    Route::delete('/expert', [ExpertController::class, 'destroy']);
    Route::post('/logout_expert', [ExpertController::class, 'logout']);

    Route::post('/experience', [ExperienceController::class, 'store']);
    Route::patch('/experience/{id}', [ExperienceController::class, 'update']);
    Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);
    // user and expert
    Route::get('/expert', [ExpertController::class, 'index']);

    Route::get('/experience/{id}', [ExperienceController::class, 'show']);

    Route::get('/category', [CategoryController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/category/{id}', [CategoryController::class, 'show']);

    // only user
    Route::post('/logout_user',   [UserController::class, 'logout']);
});
