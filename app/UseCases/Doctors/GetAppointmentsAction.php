<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

class GetAppointmentsAction
{
    public function __invoke(): array
    {
        $appointments = Doctor::with('appointments')->where('id', auth()->user()->doctor->id)->first()->appointments()->paginate(4);
        $result = [
            'data' => $appointments,
        ];
        return  $result;
    }
}
