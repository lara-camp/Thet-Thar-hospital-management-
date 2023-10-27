<?php


namespace App\UseCases\Hospitals;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
use App\Traits\HttpResponses;

class FetchHospitalAdminAction
{
    public function __invoke($hospital_id): User
    {

        $data = Hospital::with('admin')->where('id', $hospital_id)->first();
        return $data->admin;
    }
}
