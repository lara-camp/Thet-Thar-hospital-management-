<?php

namespace App\UseCases\Video;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EnterVideoChatAction
{
    public function __invoke($bookingId)
    {
        $METERED_DOMAIN = env('METERED_DOMAIN');
        $METERED_SECRET_KEY = env('METERED_SECRET_KEY');
        if ($this->checkRole($bookingId)) {
            $response = Http::get("https://{$METERED_DOMAIN}/api/v1/room/{$bookingId}?secretKey={$METERED_SECRET_KEY}");

            $roomName = $response->json("roomName");
            return $roomName;
        }
        return "Nope";
    }
    private function checkRole($bookingId)
    {
        $role = Auth::user()->role;
        if ($role === 'doctor') {
            $doctor = Doctor::where('user_id', Auth::id())->first();
            $id = $doctor->id;
            return $this->isExists("doctor_id", $id, $bookingId);
        } else {
            return $this->isExists("patient_id", Auth::id(), $bookingId);
        }
    }

    private function isExists($column, $id, $bookingId)
    {

        return Appointment::where($column, $id)->where('booking_id', $bookingId)->where('appointment_type', 'video')->exists();
    }
}
