<?php


namespace App\UseCases\Hospitals;

use App\Helpers\FileHelper;
use App\Models\Hospital;
use App\Traits\HttpResponses;

class StoreHospitalAction
{
    use HttpResponses;
    public function __invoke($formData): int
    {
        Hospital::create($formData);

        return 201;
    }
}
