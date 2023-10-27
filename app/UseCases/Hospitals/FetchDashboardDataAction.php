<?php


namespace App\UseCases\Hospitals;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Traits\HttpResponses;

class FetchDashboardDataAction
{

    public function __invoke($hospital_id): array
    {

        $doctorCount = Doctor::where('hospital_id', $hospital_id)->count();
        $patientCount = Patient::where('hospital_id', $hospital_id)->count();
        $appointmentCount = Doctor::where('hospital_id', $hospital_id)
            ->with('appointments') // Eager load appointments relationship
            ->get()
            ->pluck('appointments')
            ->flatten()
            ->count();

        $data = [
            'doctorCount' => $doctorCount,
            'patientCount' => $patientCount,
            'appointmentCount' => $appointmentCount
        ];

        return $data;
    }
}
