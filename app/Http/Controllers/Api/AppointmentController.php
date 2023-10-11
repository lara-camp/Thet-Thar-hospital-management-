<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\UseCases\Doctors\FetchTodayAppointmentForDoctorAction;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentTimeResource;
use App\UseCases\Doctors\CheckAppointmentAction;
use App\UseCases\Appointments\EditAppointmentAction;
use App\UseCases\Doctors\FetchAppointmentTimeAction;
use App\UseCases\Appointments\FetchAppointmentAction;
use App\UseCases\Appointments\StoreAppointmentAction;
use App\UseCases\Appointments\DeleteAppointmentAction;
use App\UseCases\Appointments\UpdateForLeaveChatAction;

class AppointmentController extends Controller
{
    use HttpResponses;


    public function index()
    {
        $result = (new FetchAppointmentAction)();
        return response()->json([
            'data' => AppointmentResource::collection($result['data']),
            'meta' => $result['meta'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        (new StoreAppointmentAction)($request->all());
        return $this->success('Successfully inserted.', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return $this->success('Data fetched successfully.', $appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $doctor = (new EditAppointmentAction)($request->all(), $appointment);
        return $this->success('Successfully updated.', $doctor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        (new DeleteAppointmentAction)($appointment);
        return $this->success('Successfully Deleted', null);
    }

    public function checkAppointment(Request $request)
    {
        $formData = $request->all();
        $result = (new CheckAppointmentAction)($formData);

        return $this->success($result['msg'], $result['booking_id']);
    }



    public function appointmentsTime($doctorId)
    {
        $result = (new FetchAppointmentTimeAction)($doctorId);
        return response()->json([
            'data' => AppointmentTimeResource::collection($result)
        ]);
    }

    public function todayAppointmentForDoctor()
    {
        $result = (new FetchTodayAppointmentForDoctorAction())();
        return response()->json([
            'data' =>  AppointmentResource::collection($result)
        ]);
    }

    public function leaveChat($bookingId)
    {
        $result = (new UpdateForLeaveChatAction)($bookingId);
        return $this->success('Leave Successfully.', null);
    }
}
