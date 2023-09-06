<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginLogoutController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

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

Route::post('/login', [LoginLogoutController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginLogoutController::class, 'logout']);
    //ADD MORE ROUTES HERE

});

Route::apiResource('/doctors', DoctorController::class);
Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetMail']);
Route::post('/password/reset', [ForgotPasswordController::class, 'resetNewPassword']);
Route::post("/register", [RegisterController::class, "Register"])->middleware("throttle:60,1");
