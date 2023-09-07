<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class DeleteHospitalAction
{
    use HttpResponses;
    public function __invoke($hospital): int
    {
       $hospital->delete();
       return 200;
    }
}
