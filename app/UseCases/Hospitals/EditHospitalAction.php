<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class EditHospitalAction
{
    public function __invoke($formData, $hospital): Hospital
    {
        if (request()->hasFile('image')) {
            $hospital->images()->delete();
        }
        $hospital->update($formData);

        return $hospital;
    }
}
