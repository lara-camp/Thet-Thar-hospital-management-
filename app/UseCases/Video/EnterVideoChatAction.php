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

        $checkBookingId = Appointment::where('booking_id', $bookingId)
            ->where('appointment_type', 'video')
            ->where('status', 'upcoming')
            ->first();
        if ($checkBookingId) {
            $response = Http::get("https://{$METERED_DOMAIN}/api/v1/room/{$bookingId}?secretKey={$METERED_SECRET_KEY}");

            $roomName = $response->json("roomName");
            return $roomName;
        }
        return;
    }
}
