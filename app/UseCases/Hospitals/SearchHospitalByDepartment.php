<?php

namespace App\UserCases\Hospitals;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Collection;

class SearchHospitalByDepartment
{
    use HttpResponses;

    public function __invoke(Request $request): Collection
    {
        $hospitals = new Collection([]);
        foreach ($this->getDoctorsByDepartment($request->department) as $doctor) {
            $hospitals = $hospitals->merge($doctor->hospitals);
        }
        return $hospitals;
    }

    private function getDoctorsByDepartment(string $department): Collection
    {
        $doctors = new Collection([]);
        $departments = Department::with('doctors')->where('name', 'LIKE', '%' . $department . '%')->get();
        foreach ($departments as $department) {
            $doctors = $doctors->merge($department->doctors);
        }
        return $doctors;
    }
}
