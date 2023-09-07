<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class EditHospitalAction
{
    use HttpResponses;
    public function __invoke($formData, $hospital): Hospital
    {
        $hospital->update($formData);   
        return $hospital;
    }
}
