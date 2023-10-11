<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Events\MessageNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/event', function(){
    event(new MessageNotification("This is our first broadcast message"));
});

Route::get('/test',[\App\Http\Controllers\Api\MessageController::class, 'testing']);

Route::get('/listen', function () {
    return view('listen');
});

Route::get("/email/verify/{id}/{hash}", [RegisterController::class, "verify"])->name("verify.email");
