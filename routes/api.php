<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExpertController;
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


Route::post('/experience', [ExperienceController::class, 'store']);
Route::get('/experience/{id}', [ExperienceController::class, 'show']);
Route::patch('/experience/{id}', [ExperienceController::class, 'update']);
Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
