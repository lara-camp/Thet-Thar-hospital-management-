<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;

class EditDoctorAction
{
    public function __invoke($formData, $doctor): Doctor
    {
        $doctor->update($formData);
        return  $doctor;
    }
}
