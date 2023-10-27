<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\Auth\LoginWithGoogle;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginLogoutController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ProviderServiceController;
use App\Http\Controllers\VideoController;

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
Route::get('/video', [VideoController::class, 'createMeeting']);
Route::get('/auth/{provider}', [ProviderServiceController::class, 'redirectToGoogle']);
Route::get('/auth/callback/{provider}', [ProviderServiceController::class, 'handleGoogleCallback']);
Route::get('/video-chat/{meetingId}', [AppointmentController::class, 'redirectToMeetingPage']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/enter-video-chat/{bookingId}', [AppointmentController::class, 'enterVideoChat']); //Video chat
    Route::get('/auth-user', [UserController::class, 'authUserInfo']);
    Route::post('/logout', [LoginLogoutController::class, 'logout']);
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/hospitals', HospitalController::class);
    Route::apiResource('/doctors', DoctorController::class);
    Route::apiResource('/patients', PatientController::class);
    Route::apiResource('/appointments', AppointmentController::class);
    Route::get('/departments', [DepartmentController::class, 'departments']);
    Route::get('/all-departments', [DepartmentController::class, 'fetchAllDepartments']);
    Route::post('/departments', [DepartmentController::class, 'create']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update']);
    Route::delete('/departments/{department}', [DepartmentController::class, 'delete']);
    Route::get('/hospital/{hospitalId}/doctors', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/search-hospitals-by-department', [DepartmentController::class, 'searchHospitalByDepartment']);
    Route::post('/check-appointment', [AppointmentController::class, 'checkAppointment']);
    Route::get('/{doctorId}/appointments', [AppointmentController::class, 'appointmentsTime']);
    Route::get('/today-appointment', [AppointmentController::class, 'todayAppointmentForDoctor']);
    Route::post('/image-upload', [ImageController::class, 'store']);
    Route::delete('/image-upload/{id}', [ImageController::class, 'delete']);
    Route::get('/message/{receiverId?}', [MessageController::class, 'index']);
    Route::post('/message/{receiverId?}', [MessageController::class, 'store']);
    Route::post('/leave-chat/{bookingId}', [AppointmentController::class, 'leaveChat']);
    Route::get('/dashboard/hospital/{hospitalId}/doctors', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/normal-users', [UserController::class, 'index']);
    Route::get('/dashboard/{hospitalId}/head/assign', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/hospital/{hospitalId}/head', [HospitalController::class, 'headInfo']);
    Route::get('/dashboard/hospital/{hospitalId}', [HospitalController::class, 'dashboardData']);
    Route::put('/dashboard/{hospitalId}/head', [HospitalController::class, 'updateHead']);
    Route::get('/appointment/export', [DoctorController::class, 'exportAppointment']);
    Route::get('/fetch-hospital', [UserController::class, 'fetchUserHospital']); //fetch the user of hospital if user is HospitalAdmin
    // Doctor Dashboard
    Route::get('/dashboard/doctor/{doctor}/counts', [DoctorController::class, 'doctorInfo']);
    Route::get('/dashboard/doctor/{doctor}/hospitals', [DoctorController::class, 'hospitals']);
    Route::get('/dashboard/doctor/{doctor}/patients', [DoctorController::class, 'patients']);
    Route::put('/dashboard/doctor/{doctor}/update', [DoctorController::class, 'updateProfile']);
    Route::get('/dashboard/doctor/{doctor}/appointments', [DoctorController::class, 'appointments']);
});


Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetMail']);
Route::post('/password/reset', [ForgotPasswordController::class, 'resetNewPassword']);
Route::post('/register', [RegisterController::class, 'register']);
