<?php
namespace App\UseCases\Patients;


class DeletePatientAction{

    public function __invoke($patient) : int
    {
        $patient->delete();
        return 200;
    }
}
