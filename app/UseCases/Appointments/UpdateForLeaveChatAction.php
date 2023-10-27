<?php

namespace App\UseCases\Appointments;

use App\Models\Appointment;

class UpdateForLeaveChatAction
{
    public function __invoke($bookingId): int
    {
        $appointment = Appointment::where('booking_id', $bookingId)->first();
        $appointment->update([
            'is_visible' => false,
            'status' => 'completed'
        ]);
        return 200;
    }
}
