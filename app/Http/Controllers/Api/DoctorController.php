<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\HospitalResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\UseCases\Doctors\EditDoctorAction;
use App\UseCases\Doctors\FetchDoctorAction;
use App\UseCases\Doctors\StoreDoctorAction;
use App\UseCases\Doctors\DeleteDoctorAction;
use Illuminate\Database\Eloquent\Collection;

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

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->address = $request->address;
        $doctor->password = $request->password ? Hash::make($request->password) : $doctor->password;
        $doctor->update();

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
}
