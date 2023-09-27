<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CheckAppointmentAction
{
    public function __invoke($formData)
    {
        $time = $formData['appointment_time'];
        $date = $formData['appointment_date'];
        $doctorId = $formData['doctor_id'];
        $result = '';
        $checkAppointmentTime = Appointment::where('doctor_id', $doctorId)->where('appointment_time', $time)->where('appointment_date', $date)->first();

        if ($checkAppointmentTime != null) {
            return $result = 'You cannot book this appointment. Please choose another time.';
        } else {
            Appointment::create($formData);
            return $result = 'Appointment booked successfully.';
        }
        return $result;
    }
}
