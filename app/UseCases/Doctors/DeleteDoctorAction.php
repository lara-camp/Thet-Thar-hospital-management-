<?php

namespace App\UseCases\Doctors;

class DeleteDoctorAction
{
    public function __invoke($doctor): int
    {
        $doctor->delete();
        return 200;
    }
}
