<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointmentTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class FetchAppointmentTimeAction
{
    public function __invoke($doctorId): Collection
    {
        $times = AppointmentTime::where('doctor_id', $doctorId)->get();
        return $times;
    }
}
