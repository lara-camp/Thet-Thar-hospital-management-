<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
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
        $department = $request->department;
        $hospitals = Department::where('name', 'LIKE', '%'. $department .'%')->first();

        return $this->success('Fetched hospitals by department.', ['hospitals' => $hospitals->doctors]);
    }
}
