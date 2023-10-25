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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckAppointmentAction
{

    public function __invoke($formData)
    {
        $appointmentTime = Carbon::parse($formData['appointment_time']);
        $doctorId = $formData['doctor_id'];
        $currentDate = Carbon::now()->format('Y-m-d');
        $appointmentDate = Carbon::parse($formData['appointment_date']);
        $bookingId = $this->generateBookingId();
        $formData['booking_id'] = $bookingId;

        if (!$this->isAvailableTime($doctorId, $appointmentTime)) {
            return $this->response('Appointment time is unavailable. Please choose another time.');
        }

        $existingAppointment = $this->findExistingAppointment($doctorId, $appointmentTime, $appointmentDate);

        if ($existingAppointment) {
            return $this->response('You cannot book this appointment. Please choose another time.');
        }

        if ($this->isFutureOrCurrentDate($appointmentDate, $currentDate)) {
            if($formData['appointment_type'] === 'video'){
                $roomName = $this->createMeeting();
                $bookingId = $roomName;
                $formData['booking_id'] = $roomName;
            }
                $appointment = $this->createAppointment($formData);
                $this->notifyPatientAndDoctor($appointment, $bookingId);
                return $this->response('Appointment booked successfully.', $bookingId);
        }

        return $this->response('Appointment time is over. Please choose another time.');
    }

    private function createMeeting()
    {
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');

        $response = Http::post("https://{$METERED_DOMAIN}/api/v1/room?secretKey={$METERED_SECRET_KEY}", [
            'autoJoin' => false
        ]);

        $roomName = $response->json('roomName');
        return $roomName;
    }

    private function isAvailableTime($doctorId, $appointmentTime)
    {
        return AppointmentTime::where('doctor_id', $doctorId)
            ->where('appointment_time', $appointmentTime)
            ->exists();
    }

    private function findExistingAppointment($doctorId, $appointmentTime, $appointmentDate)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_time', $appointmentTime->format("H:i:s"))
            ->where('appointment_date', $appointmentDate->format('Y-m-d'))
            ->first();
    }

    private function isFutureOrCurrentDate($appointmentDate, $currentDate)
    {
        return $appointmentDate->greaterThanOrEqualTo($currentDate);
    }

    private function generateBookingId()
    {
        return substr(crc32(uniqid()), 0, 6);
    }

    private function createAppointment($formData)
    {
        $formData['patient_id'] = Auth::id();
        return Appointment::create($formData);
    }

    private function notifyPatientAndDoctor($appointment, $bookingId)
    {
        $userInfo = User::find($appointment->patient_id);
        Mail::to($userInfo->email)->queue(new NotifMail($userInfo->name, $appointment));
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $appointment->doctor_id,
            'booking_id' => $bookingId,
            'message' => $appointment->description,
        ]);
    }

    private function response($message, $bookingId = null)
    {
        return ['msg' => $message, 'booking_id' => $bookingId];
    }
}
