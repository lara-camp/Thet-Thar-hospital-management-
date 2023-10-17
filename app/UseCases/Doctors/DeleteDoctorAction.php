<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\User;

class DeleteDoctorAction
{
    public function __invoke($doctor): int
    {
        $deleteData = User::where('id', $doctor->user_id)->firstOrFail();
        $doctor->update([
            'is_visible' => false,
        ]); //Doctor Table
        $deleteData->update([
            'is_visible' => false,
        ]); //User Table
        return 200;
    }
}
