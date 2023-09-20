<?php

namespace App\UseCases\Appointments;

use App\Models\Appointment;

class DeleteAppointmentAction
{
    public function __invoke($appointment): int
    {
        $deleteData = Appointment::where('id', $appointment->id)->firstOrFail();
        $deleteData->update([
            'is_visible' => false,
        ]);
        return 200;
    }
}
