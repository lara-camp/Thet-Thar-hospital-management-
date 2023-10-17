<?php

namespace App\UseCases\Doctors;

use App\Events\MessageSending;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Mail\NotifMail;
use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Models\AppointmentTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckAppointmentAction
{

    public function __invoke($formData)
    {
        $appointment_time = $formData['appointment_time'];
        $doctorId = $formData['doctor_id'];
        $current_date = Carbon::now()->format('Y-m-d');
        $appointment_date = Carbon::parse($formData['appointment_date']);
        //Check if the time exists in the AppointmentTime table
        $existingTime = AppointmentTime::where('doctor_id', $doctorId)->where('appointment_time', $appointment_time)->exists();
        if ($existingTime) {
            $existingAppointment = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_time', $appointment_time)
                ->where('appointment_date', $appointment_date)
                ->first();

            if ($existingAppointment) {
                return [
                    'msg' => 'You cannot book this appointment. Please choose another time.',
                    'booking_id' => null
                ];
            } else {
                if (($appointment_date->greaterThan($current_date) || $appointment_date->equalTo($current_date)) && Carbon::parse($appointment_time)->greaterThan(Carbon::now()->format('H:i:s'))) {
                    $numberOfDigits = 6;
                    $uniqueNumber = substr(crc32(uniqid()), 0, $numberOfDigits);
                    $booking_id = $uniqueNumber;
                    $formData['booking_id'] = $booking_id;
                    $patientId = Auth::id(); //To Fix
                    $formData['patient_id'] = $patientId;
                    $formData['doctor_id'] = $doctorId;
                    $appointment = Appointment::create($formData);
                    $patient_name = User::where('id', $patientId)->first();
                    Mail::to($patient_name->email)->send(new NotifMail($patient_name->name, $appointment));

                    $doctor = Doctor::where('id',$doctorId)->first();
                    $receiverId = $doctor->userInfo->id;

                    Message::create([
                       'sender_id' => Auth::id(),
                       'receiver_id' =>  $receiverId,
                        'booking_id' => $booking_id,
                        'message' => $formData['description']
                    ]);

                    return [
                        'msg' => 'Appointment booked successfully.',
                        'booking_id' => $booking_id
                    ];
                } else {
                    return [
                        'msg' => 'Appointment time is over. Please choose another time.',
                        'booking_id' => null
                    ];
                }
            }
        } else {
            return [
                'msg' => 'Appointment time is unavailable. Please choose another time.',
                'booking_id' => null
            ];
        }
    }
}
