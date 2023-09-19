<?php

namespace App\UseCases\Appointments;

use App\Models\Appointment;

class StoreAppointmentAction
{
    public function __invoke($formData): int
    {
        Appointment::create($formData);
        return 201;
    }
}
