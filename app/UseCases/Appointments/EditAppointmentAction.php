<?php

namespace App\UseCases\Appointments;

use App\Models\Appointment;

class EditAppointmentAction
{
    public function __invoke($formData, $appointment): Appointment
    {
        $appointment->update($formData);
        return  $appointment;
    }
}
