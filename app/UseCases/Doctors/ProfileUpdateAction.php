<?php

namespace App\UseCases\Doctors;

use App\Models\User;

class ProfileUpdateAction
{
    public function __invoke($formData, $doctor): User
    {
        $doctor->update($formData);
        return  $doctor;
    }
}
