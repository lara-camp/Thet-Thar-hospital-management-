<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\HospitalResource;

class DoctorDashboardController extends Controller
{
    public function hospitals()
    {
        $hospitals = Doctor::with('hospitals')->where('id', 2)->firstOrFail()->hospitals;
        return response()->json([
            'data' => HospitalResource::collection($hospitals),
        ]);
    }

    public function patients()
    {
        $patients = new Collection([]);
        $data = Doctor::with('patients')->where('id', 2)->firstOrFail()->patients;
        foreach ($data as $value) {
            $patients = $patients->add(($value->userInfo));
        }
        return response()->json([
            'data' => UserResource::collection($patients),
        ]);
    }
}
