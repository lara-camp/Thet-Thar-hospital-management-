<?php

namespace App\Http\Controllers\Api;

use App\Models\Hospital;
use App\Traits\HttpResponses;
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
    public function index()
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
    public function store(HospitalRequest $request)
    {
        (new StoreHospitalAction())($request->all());
        return $this->success('Inserted hospital successfully.', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        return $this->success('Fetched hospital successfully.', new HospitalResource($hospital));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $hospital = (new EditHospitalAction())($request->all(), $hospital);
        return $this->success('Updated hospital successfully.',  new HospitalResource($hospital));
    }

    public function destroy(Hospital $hospital)
    {
        (new DeleteHospitalAction())($hospital);
        return $this->success('Hospital deleted successfully.', null);
    }

    public function hospitalDoctors($id)
    {
        $result = (new FetchHospitalDoctorAction())($id);
        return response()->json([
            'data' => DoctorResource::collection($result['data']),
            'meta' => $result['meta']
        ]);
    }

    public function dashboardData($id)
    {
        $result = (new FetchDashboardDataAction())($id);
        return response()->json([
            'data' => $result
        ]);
    }

    public function headInfo($hospitalId) //head=>Headmaster
    {
//        return $hospitalId;
        $result = (new FetchHospitalAdminAction)($hospitalId);
        return response()->json([
            'data' => $result
        ]);
    }

    public function updateHead(Hospital $hospitalId)
    {
        (new UpdateHospitalAdminAction)($hospitalId);
        return $this->success('Updated hospital head successfully.', null);
    }
}
