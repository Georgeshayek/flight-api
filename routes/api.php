<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//users API's
Route::get('/users',[UserController::class,'index']);
Route::post('/users/create',[UserController::class,'store']);
Route::put('/users/{user}/edit',[UserController::class,'update']);
Route::delete('/users/{user}',[UserController::class,'destroy']);
Route::get('/users/{user}',[UserController::class,'show']);

Route::get('/passengers',[PassengerController::class,'index']);
Route::get('/flights',[FlightController::class,'index']);
Route::get('/flights/{flight}',[FlightController::class,'show']);