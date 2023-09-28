<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\UseCases\Doctors\EditDoctorAction;
use App\UseCases\Doctors\FetchDoctorAction;
use App\UseCases\Doctors\StoreDoctorAction;
use App\UseCases\Doctors\DeleteDoctorAction;

class DoctorController extends Controller
{
    use HttpResponses;


    public function index()
    {
        $result = (new FetchDoctorAction)();
        return response()->json([
            'data' => DoctorResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {

        (new StoreDoctorAction)($request->all());
        return $this->success('Successfully inserted.', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return $this->success('Data fetched successfully.', $doctor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor = (new EditDoctorAction)($request->all(), $doctor);
        return $this->success('Successfully updated.', $doctor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        (new DeleteDoctorAction)($doctor);
        return $this->success('Successfully Deleted', null);
    }
}
