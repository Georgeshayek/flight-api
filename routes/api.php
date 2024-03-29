<?php

use App\Http\Controllers\AuthController;
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
Route::put('/passengers/{passenger}/uploadimage', [PassengerController::class, 'uploadImage']);
Route::group(['middleware' => ['sanitize.input']], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::get('/users/export/', [UserController::class, 'export']);
Route::post('/users/import/', [UserController::class, 'import']);
Route::get('/passengers', [PassengerController::class, 'index']);

//users API's
Route::group(['middleware' => ['auth:sanctum', 'throttle:api']], function () {
    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::resource('users', UserController::class);
    });
    Route::get('/flights', [FlightController::class, 'index']);
    Route::get('/flights/{flight}', [FlightController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
