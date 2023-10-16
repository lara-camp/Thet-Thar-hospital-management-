<?php


namespace App\UseCases\Doctors;


use App\Models\Appointment;
use App\Models\User;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FetchTodayAppointmentForDoctorAction
{
    use HttpResponses;

    public function __invoke(): Collection
    {
        $today = Carbon::now()->format('Y-m-d');
        $user = User::where('id', Auth::id())->first();
        $doctorId = $user->doctor->id;
        $appointments = Appointment::where('appointment_date', $today)->where('doctor_id', $doctorId)->get();
        return $appointments;
    }
}
