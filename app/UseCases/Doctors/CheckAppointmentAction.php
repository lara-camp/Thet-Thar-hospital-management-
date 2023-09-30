<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointmentTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CheckAppointmentAction
{
    public function __invoke($formData)
    {

        $time = $formData['appointment_time'];
        $date = $formData['appointment_date'];
        $doctorId = $formData['doctor_id'];
        //Check if the time exists in the AppointmentTime table
        $existingTime = AppointmentTime::where('doctor_id', $doctorId)->where('appointment_time', $time)->exists();

        if ($existingTime) {
            $existingAppointment = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_time', $time)
                ->where('appointment_date', $date)
                ->first();

            if ($existingAppointment) {
                return [
                    'msg' => 'You cannot book this appointment. Please choose another time.',
                    'booking_id' => null
                ];
            } else {
                $numberOfDigits = 6;
                $uniqueNumber = substr(crc32(uniqid()), 0, $numberOfDigits);
                $booking_id = $uniqueNumber;
                $formData['booking_id'] = $booking_id;
                $patientId = Auth::id();
                $formData['patient_id'] = $patientId;
                $formData['doctor_id'] = $doctorId;
                Appointment::create($formData);

                return [
                    'msg' => 'Appointment booked successfully.',
                    'booking_id' => $booking_id
                ];
            }
        } else {
            return [
                'msg' => 'Appointment time is unavailable. Please choose another time.',
                'booking_id' => null
            ];
        }
    }
}
