<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/expert', [ExpertController::class, 'index']);
Route::post('/expert', [ExpertController::class, 'store']);
Route::get('/expert/{id}', [ExpertController::class, 'show']);
Route::patch('/expert/{id}', [ExpertController::class, 'update']);
Route::delete('/expert/{id}', [ExpertController::class, 'destroy']);

Route::post('login_expert', [ExpertController::class, 'login']);
Route::post('logout_expert', [experta::class, 'logout']);


Route::post('/experience', [ExperienceController::class, 'store']);
Route::get('/experience/{id}', [ExperienceController::class, 'show']);
Route::patch('/experience/{id}', [ExperienceController::class, 'update']);
Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);


Route::post('create_user', [UserController::class, 'store']);
Route::post('login_user', [UserController::class, 'login'])->name('login');
