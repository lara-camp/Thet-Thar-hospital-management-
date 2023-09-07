<?php

namespace App\UseCases\Patients;

use App\Traits\HttpResponses;
use App\Models\Patient;

class EditPatientAction
{
    use HttpResponses;

    public function __invoke($formData , $patient) : Patient
    {
        $patient->update($formData);
        return $patient;
    }
}
