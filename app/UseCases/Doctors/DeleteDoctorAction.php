<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Models\User;

class DeleteDoctorAction
{
    public function __invoke($doctor): int
    {
        $deleteData = User::where('id', $doctor->user_id)->firstOrFail();
        $deleteData->update([
            'is_visible' => false,
        ]);
        return 200;
    }
}
