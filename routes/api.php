<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\studentcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('logout',[Authcontroller::class,'logout']);
    Route::prefix('student')-> group(function(){
        Route::post('store',[studentcontroller::class,'store']);
        Route::post('update/{id}',[studentcontroller::class,'update']);
        Route::get('show',[studentcontroller::class,'showstudentcourses']);

    });
});


Route::post('register',[Authcontroller::class,'register']);
Route::post('login',[Authcontroller::class,'login']);