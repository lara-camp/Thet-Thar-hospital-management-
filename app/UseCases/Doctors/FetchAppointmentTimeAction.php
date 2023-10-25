<?php

namespace App\UseCases\Doctors;

use App\Models\AppointmentTime;
use Illuminate\Database\Eloquent\Collection;

class FetchAppointmentTimeAction
{
    public function __invoke($doctorId): Collection
    {
        $times = AppointmentTime::where('doctor_id', $doctorId)->get();
        return $times;
    }
}
