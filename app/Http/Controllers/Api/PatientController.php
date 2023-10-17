<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\UseCases\Patients\EditPatientAction;
use App\UseCases\Patients\FetchPatientAction;
use App\UseCases\Patients\DeletePatientAction;

class PatientController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $result = (new FetchPatientAction)();
        return response()->json([
            'data' => PatientResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient): JsonResponse
    {
        return $this->success('Data fetched successfully.', $patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient): JsonResponse
    {
        $patient = (new EditPatientAction)($request->all(), $patient);
        return $this->success('Successfully updated.', $patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient): JsonResponse
    {
        (new DeletePatientAction)($patient);
        return $this->success('Successfully Deleted', null);
    }
}
