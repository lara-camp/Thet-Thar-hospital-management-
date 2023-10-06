<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\HospitalResource;

class DepartmentController extends Controller
{
    use HttpResponses;
    public function departments()
    {
        $departments = Department::all();
        return response()->json([
            'data' => DepartmentResource::collection($departments),
        ]);
    }

    public function searchHospitalByDepartment(Request $request)
    {

        $doctors = new Collection([]);
        $departments = Department::with('doctors')->where('name', 'LIKE', '%' . $request->department . '%')->get();
        foreach ($departments as $department) {
            $doctors = $doctors->merge($department->doctors);
        }
        $hospitals = new Collection([]);
        foreach ($doctors as $doctor) {
            $hospitals = $hospitals->merge($doctor->hospitals);
        }
        return $this->success('Fetched hospitals by department.', ['hospitals' => HospitalResource::collection($hospitals->unique('id'))]);
    }
}
