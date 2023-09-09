<?php

namespace App\UseCases\Patients;


use App\Models\Patient;
use App\Models\User;

class DeletePatientAction
{

    public function __invoke($patient): int
    {
        $deleteData = User::where("id",$patient->user_id)->firstOrFail();
        $deleteData->update([
            "is_visible" => false,
        ]);
        return 200;
    }
}
