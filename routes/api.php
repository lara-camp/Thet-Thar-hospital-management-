<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginLogoutController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ImageController;

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
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/hospitals', HospitalController::class);
    Route::apiResource('/doctors', DoctorController::class);
    Route::apiResource('/patients', PatientController::class);
    Route::apiResource('/appointments', AppointmentController::class);
    Route::get('/departments', [DepartmentController::class, 'departments']);
    Route::post('/departments', [DepartmentController::class, 'create']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update']);
    Route::delete('/departments/{department}', [DepartmentController::class, 'delete']);
    Route::get('/hospital/{hospitalId}/doctors', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/search-hospitals-by-department', [DepartmentController::class, 'searchHospitalByDepartment']);
    Route::post('/check-appointment', [AppointmentController::class, 'checkAppointment']);
    Route::get('/{doctorId}/appointments', [AppointmentController::class, 'appointmentsTime']);
    Route::post('/image-upload', [ImageController::class, 'store']);
    Route::delete('/image-upload/{id}', [ImageController::class, 'delete']);
    Route::get('/dashboard/hospital/{hospitalId}/doctors', [HospitalController::class, 'hospitalDoctors']);
});


Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetMail']);
Route::post('/password/reset', [ForgotPasswordController::class, 'resetNewPassword']);
Route::post('/register', [RegisterController::class, 'register']);
