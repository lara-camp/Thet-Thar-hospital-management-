<?php

namespace App\UseCases\Appointments;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;

class StoreAppointmentAction
{
    public function __invoke($formData): int
    {
        Appointment::create($formData);

        // Notification for patien
        $patientUser = Patient::with('userInfo')->where('id', $formData['patient_id'])->first()->userInfo;
        $title = 'Your appointment is successfully created.';
        $message = 'Typically, notifications should be short, informational messages that notify users of something that occurred in your application.';
        $sourceable_id = null;
        $sourceable_type = null;
        $web_link = null;
        Notification::send([$patientUser], new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));

        // Notification for doctor
        $doctorUser = Doctor::with('userInfo')->where('id', $formData['doctor_id'])->first()->userInfo;
        $title = 'You has a new appointment.';
        $message = 'Typically, notifications should be short, informational messages that notify users of something that occurred in your application.';
        $sourceable_id = $formData['patient_id'];
        $sourceable_type = Patient::class;
        $web_link = null;
        Notification::send([$doctorUser], new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));

        return 201;
    }
}
