<?php

use App\Models\Doctor;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\DoctorDashboardController;
use App\Http\Controllers\Api\Auth\LoginLogoutController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

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
    Route::get('/message/{receiverId?}',[MessageController::class, 'index']);
    Route::post('/message/{receiverId?}',[MessageController::class, 'store']);
    Route::get('/dashboard/hospital/{hospitalId}/doctors', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/normal-users', [UserController::class, 'index']);
    Route::get('/dashboard/{hospitalId}/head/assign', [HospitalController::class, 'hospitalDoctors']);
    Route::get('/hospital/{hospitalId}/head', [HospitalController::class, 'headInfo']);
    Route::get('/dashboard/hospital/{hospitalId}', [HospitalController::class, 'dashboardData']);
    Route::put('/dashboard/{hospitalId}/head', [HospitalController::class, 'updateHead']);

    // Doctor dashboard
    Route::get('/dashboard/doctor/{doctor}/hospitals', [DoctorDashboardController::class, 'hospitals']);
    Route::get('/dashboard/doctor/{doctor}/patients', [DoctorDashboardController::class, 'patients']);
});

Route::get('/test', function(){
    $user = Doctor::with('userInfo')->where('id', 2)->first()->userInfo;
    
    $title = 'Testing Notification';
    $message = 'Typically, notifications should be short, informational messages that notify users of something that occurred in your application. For example, if you are writing a billing application, you might send an "Invoice Paid" notification to your users via the email and SMS channels.';
    $sourceable_id = 1;
    $sourceable_type = Patient::class;
    $web_link = null;
    
    Notification::send([$user], new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));
    return $user;
});

Route::post('/password/email',  [ForgotPasswordController::class, 'sendResetMail']);
Route::post('/password/reset', [ForgotPasswordController::class, 'resetNewPassword']);
Route::post('/register', [RegisterController::class, 'register']);
