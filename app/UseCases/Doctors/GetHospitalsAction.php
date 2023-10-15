<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;

class GetHospitalsAction
{
    public function __invoke(): array
    {
        $hospitals = Doctor::with('hospitals')->where('id', auth()->user()->doctor->id)->firstOrFail()->hospitals;
        $result = [
            'data' => $hospitals,
        ];
        return  $result;
    }
}
