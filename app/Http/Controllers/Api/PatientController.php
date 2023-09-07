<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Doctor;
use App\Models\Patient;
use App\Traits\HttpResponses;
use App\UseCases\Patients\DeletePatientAction;
use App\UseCases\Patients\EditPatientAction;
use App\UseCases\Patients\FetchPatientAction;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = (new FetchPatientAction)();
        return response()->json([
            "data" => PatientResource::collection($result['data']),
            "meta" => $result['meta'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return $this->success("Data fetched successfully.", $patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $patient = (new EditPatientAction)($request->all() , $patient);
        return $this->success("Successfully updated.",$patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        (new DeletePatientAction)($patient);
        return $this->success("Successfully Deleted", null);
    }
}
