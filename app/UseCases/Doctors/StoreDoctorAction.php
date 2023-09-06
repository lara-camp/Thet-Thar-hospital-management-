<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;

class StoreDoctorAction
{
    public function __invoke($formData): int
    {
        Doctor::create($formData);
        return  201;
    }
}
