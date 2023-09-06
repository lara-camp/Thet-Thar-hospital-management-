<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;

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

Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetMail']);
Route::post('/password/reset', [ForgotPasswordController::class, 'resetNewPassword']);
Route::post("/register",[RegisterController::class, "Register"])->middleware("throttle:60,1");

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// });
