<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\AuthController;
use App\HTTP\Controllers\TestController;
use App\HTTP\Controllers\appoController;
use App\HTTP\Controllers\usera;
use App\HTTP\Controllers\experta;

/*Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::apiResource('posts',PostController::class);
    ........add the routes......});
Route::post('register',[AuthController::class,'createuser']);
Route::post('login',[AuthController::class,'loginuser']);
Route::post('logout',[AuthController::class,'logout']);

Route::post('loguser',[usera::class,'login']);
Route::middleware(['auth:sanctum', 'type.customer'])->group(function () {
    Route::post('testex', [TestController::class, 'test2']);

});
Route::post('logex',[experta::class,'login']);
Route::middleware(['auth:sanctum', 'type.driver'])->group(function () {
    Route::post('testus', [TestController::class, 'test1']);
});


Route::group(['middleware' => 'ExpertAccess'],function (){
    Route::post('testex', [TestController::class, 'test2']);
    });
Route::group(['middleware' => 'UserAccess'],function (){
    Route::post('testus', [TestController::class, 'test1']);
    });

Route::post('register',[AuthController::class,'createuser']);
Route::post('login',[AuthController::class,'loginuser']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class,'logoutuser']); 

*/
Route::post('loginus', [usera::class, 'login'])->name('login');
Route::post('loginex', [experta::class, 'login'])->name('login');
Route::post('createus', [usera::class, 'createuser']);
Route::post('createex', [experta::class, 'create']);
Route::post('logoutex', [experta::class, 'logout']);
Route::middleware('auth:sanctum')->post('logout', [usera::class,'logout2']); 

// Only for customers
Route::group(['middleware'=>['auth:sanctum', 'type.customer']],function () {
    Route::post('testus', [TestController::class, 'test1']);
});

// Only for drivers
Route::middleware(['auth:sanctum', 'type.driver'])->group(function () {
    Route::post('testex', [TestController::class, 'test2']);
});
Route::post('booking',[appoController::class , 'booking_appo']);
Route::get('sh',[appoController::class , 'shwo_available_time']);
