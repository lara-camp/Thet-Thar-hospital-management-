<?php

namespace App\Http\Controllers\Api;

use App\Models\Hospital;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalRequest;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\HospitalResource;
use App\UseCases\Hospitals\EditHospitalAction;
use App\UseCases\Hospitals\FetchHospitalAction;
use App\UseCases\Hospitals\StoreHospitalAction;
use App\UseCases\Hospitals\DeleteHospitalAction;
use App\UseCases\Hospitals\FetchDashboardDataAction;
use App\UseCases\Hospitals\FetchHospitalAdminAction;
use App\UseCases\Hospitals\FetchHospitalDoctorAction;
use App\UseCases\Hospitals\UpdateHospitalAdminAction;

class HospitalController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $result = (new FetchHospitalAction())();
        return response()->json([
            'data' => HospitalResource::collection($result['data']),
            'meta' => $result['meta']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HospitalRequest $request): JsonResponse
    {
        $this->authorize('create', Hospital::class);
        (new StoreHospitalAction())($request->all());
        return $this->success('Inserted hospital successfully.', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital): JsonResponse
    {
        $this->authorize('view', $hospital);
        return $this->success('Fetched hospital successfully.', new HospitalResource($hospital));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HospitalRequest $request, Hospital $hospital): JsonResponse
    {
        $this->authorize('update', $hospital);
        $hospital = (new EditHospitalAction())($request->all(), $hospital);
        return $this->success('Updated hospital successfully.',  new HospitalResource($hospital));
    }

    //Delete Hospital
    public function destroy(Hospital $hospital): JsonResponse
    {
        $this->authorize('delete', $hospital);
        (new DeleteHospitalAction())($hospital);
        return $this->success('Hospital deleted successfully.', null);
    }

    //Get Hospital Doctors
    public function hospitalDoctors(int $id): JsonResponse
    {
        $result = (new FetchHospitalDoctorAction())($id);
        return response()->json([
            'data' => DoctorResource::collection($result['data']),
            'meta' => $result['meta']
        ]);
    }

    //Get Hospital Dashboard Data
    public function dashboardData($id): JsonResponse
    {
        $result = (new FetchDashboardDataAction())($id);
        return response()->json([
            'data' => $result
        ]);
    }

    //Get Hospital Headmaster
    public function headInfo(int $hospitalId)
    {
        $result = (new FetchHospitalAdminAction)($hospitalId);
        return response()->json([
            'data' => $result
        ]);
    }

    //Update Hospital Headmaster
    public function updateHead(Hospital $hospitalId): JsonResponse
    {
        (new UpdateHospitalAdminAction)($hospitalId);
        return $this->success('Updated hospital head successfully.', null);
    }
}
