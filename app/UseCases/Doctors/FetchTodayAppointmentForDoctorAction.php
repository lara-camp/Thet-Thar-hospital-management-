<?php


namespace App\UseCases\Doctors;


use App\Models\Appointment;
use App\Models\User;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FetchTodayAppointmentForDoctorAction
{
    use HttpResponses;

    public function __invoke()
    {
        $today = Carbon::today();
        $user = User::where('id', Auth::id())->first();
        $doctorId = $user->doctor->id;
        $appiontments = Appointment::where('appointment_date' , $today )->where('doctor_id',$doctorId)->get();
        return $appiontments;

    //    return $doctorId;
    }

}
