<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\HospitalResource;
use App\Http\Resources\DepartmentResource;
use App\UseCases\Department\FetchDepartmentAction;
use App\UseCases\Department\StoreDepartmentAction;
use App\UseCases\Department\DeleteDepartmentAction;
use App\UseCases\Department\FetchAllDepartmentAction;
use App\UseCases\Department\UpdateDepartmentAction;
use App\UserCases\Hospitals\SearchHospitalByDepartment;

class DepartmentController extends Controller
{
    use HttpResponses;

    public function departments(): JsonResponse
    {
        $result = (new FetchDepartmentAction)();
        return response()->json([
            'data' => DepartmentResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $this->authorize('create', Department::class);
        (new StoreDepartmentAction)($request->all());
        return $this->success('Successfully inserted.', null, 201);
    }

    public function update(Request $request, Department $department): JsonResponse
    {
        $this->authorize('update', $department);
        $update = (new UpdateDepartmentAction)($request->all(), $department);
        return $this->success('Successfully updated.', $update);
    }

    public function delete(Department $department): JsonResponse
    {
        $this->authorize('delete', $department);
        (new DeleteDepartmentAction)($department);
        return $this->success('Successfully deleted.');
    }

    public function searchHospitalByDepartment(): JsonResponse
    {
        $hospitals = (new SearchHospitalByDepartment)();
        return $this->success('Fetched hospitals by department.', ['hospitals' => HospitalResource::collection($hospitals->unique('id'))]);
    }

    public function fetchAllDepartments(): JsonResponse
    {
        $departments = (new FetchAllDepartmentAction)();
        return response()->json([
            'data' => DepartmentResource::collection($departments),
        ]);
    }
}
