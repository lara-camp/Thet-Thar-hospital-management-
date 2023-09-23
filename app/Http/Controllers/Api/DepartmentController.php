<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use HttpResponses;
    public function departments ()
    {
        $departments = Department::all();
        return $this->success('Fetched all departments successfully.', ['departments' => $departments]);
    }

    public function searchHospitalByDepartment(Request $request)
    {
        $doctors = Doctor::where('id', 2)->get();
        $departments = Department::with('doctors')->where('name', 'LIKE', '%'. $request->department .'%')->get();
        foreach($departments as $department) {
            $doctors->merge($department->doctors);
        }
        return $doctors;
        return $this->success('Fetched hospitals by department.', ['hospitals' => $departments]);
    }
}
