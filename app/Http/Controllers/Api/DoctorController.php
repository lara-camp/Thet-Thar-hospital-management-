<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\HospitalResource;
use Illuminate\Support\Facades\Validator;
use App\UseCases\Doctors\EditDoctorAction;
use App\Http\Resources\AppointmentResource;
use App\UseCases\Doctors\FetchDoctorAction;
use App\UseCases\Doctors\GetPatientsAction;
use App\UseCases\Doctors\StoreDoctorAction;
use App\UseCases\Doctors\DeleteDoctorAction;
use App\UseCases\Doctors\GetHospitalsAction;
use Illuminate\Database\Eloquent\Collection;
use App\UseCases\Doctors\ProfileUpdateAction;
use App\UseCases\Doctors\GetAppointmentsAction;

class DoctorController extends Controller
{
    use HttpResponses;


    public function counts (User $doctor) 
    {
        $appointmentCount = Doctor::with('appointments')->where('id', $doctor->doctor->id)->first()->appointments()->count();
        $hospitalCount = Doctor::with('hospitals')->where('id', $doctor->doctor->id)->firstOrFail()->hospitals()->count();

        $patients = new Collection([]);
        $data = Doctor::with('patients')->where('id', $doctor->doctor->id)->firstOrFail()->patients;
        foreach ($data as $value) {
            $patients = $patients->add(($value->userInfo));
        }
        $patientCount = $patients->count();
        
        return response()->json([
            'hospital' => $hospitalCount,
            'patient' => $patientCount,
            'appointment' => $appointmentCount,
        ]);
    } 

    public function index(): \Illuminate\Http\JsonResponse
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
    public function store(DoctorRequest $request): \Illuminate\Http\JsonResponse
    {

        (new StoreDoctorAction)($request->all());
        return $this->success('Successfully inserted.', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor): \Illuminate\Http\JsonResponse
    {
        return $this->success('Data fetched successfully.', $doctor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor): \Illuminate\Http\JsonResponse
    {
        $doctor = (new EditDoctorAction)($request->all(), $doctor);
        return $this->success('Successfully updated.', $doctor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor): \Illuminate\Http\JsonResponse
    {
        (new DeleteDoctorAction)($doctor);
        return $this->success('Successfully Deleted', null);
    }

    
    public function updateProfile(Request $request, User $doctor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|min:11|max:14|unique:users,phone,' . $doctor->id,
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'address' => 'nullable',
            'password' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), null, 422);
        }

        $formData = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "password" => $request->password ? Hash::make($request->password) : $doctor->password,
        ];

        $doctor = (new ProfileUpdateAction)($formData, $doctor);
        return $this->success('Successfully updated.', [
            'user' => [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'email' => $doctor->email,
                'phone' => $doctor->phone,
                'address' => $doctor->address,
                'role' => $doctor->role,
            ]
        ], 200);
    }

    public function hospitals()
    {
        $result = (new GetHospitalsAction)();
        return response()->json([
            'data' => HospitalResource::collection($result['data']),
        ]);
    }

    public function patients()
    {
        $result = (new GetPatientsAction)();
        return response()->json([
            'data' => UserResource::collection($result['data']),
        ]);
    }

    public function appointments(User $user)
    {
        $result = (new GetAppointmentsAction)();
        return response()->json([
            'data' => AppointmentResource::collection($result['data']),
        ]);
    }
}
