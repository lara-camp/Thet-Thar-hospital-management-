<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CheckAppointmentAction
{
    public function __invoke($formData)
    {
        $time = $formData['appointment_time'];
        $date = $formData['appointment_date'];
        $doctorId = $formData['doctor_id'];
        $result = [];
        $checkAppointmentTime = Appointment::where('doctor_id', $doctorId)->where('appointment_time', $time)->where('appointment_date', $date)->first();

        if ($checkAppointmentTime != null) {
            $result = [
                'msg' => 'You cannot book this appointment. Please choose another time.',
                'booking_id' => 'You cannot book this appointment. Please choose another time.'
            ];

            return $result;
        } else {
            $numberOfDigits = 6;
            $uniqueNumber = substr(crc32(uniqid()), 0, $numberOfDigits);
            $booking_id = $uniqueNumber;
            $formData['booking_id'] = $booking_id;
            Appointment::create($formData);
            return  $result = [
                'msg' => 'Appointment booked successfully.',
                'booking_id' => $booking_id
            ];;
        }
        return $result;
    }
}
