<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\UseCases\Doctors\FetchTodayAppointmentForDoctorAction;
use App\UseCases\Video\EnterVideoChatAction;
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
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
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

    //Check Appointment
    public function checkAppointment(AppointmentRequest $request)
    {
        $formData = $request->all();
        $result = (new CheckAppointmentAction)($formData);
        return $this->success($result['msg'], $result['booking_id']);
    }

    //Get Appointment Time
    public function appointmentsTime(int $doctorId)
    {
        $result = (new FetchAppointmentTimeAction)($doctorId);
        return response()->json([
            'data' => AppointmentTimeResource::collection($result)
        ]);
    }

    //Get Today Appointment For Doctor
    public function todayAppointmentForDoctor()
    {
        $result = (new FetchTodayAppointmentForDoctorAction())();
        return response()->json([
            'data' =>   AppointmentResource::collection($result)
        ]);
    }

    //enter video chat
    public function enterVideoChat($bookingId)
    {
        $roomName = (new EnterVideoChatAction())($bookingId);
        return Redirect::to("http://127.0.0.1:8000/api/video-chat/{$roomName}"); //Need to enter frontend meeting Url  //Need to update this url when frontend is ready
    }

    public function redirectToMeetingPage($meetingId)
    {
        $METERED_DOMAIN = env('METERED_DOMAIN');
        return view('meeting', [
            'METERED_DOMAIN' => $METERED_DOMAIN,
            'MEETING_ID' => $meetingId
        ]);
    }

    //Leave Chat
    public function leaveChat(int $bookingId)
    {
        (new UpdateForLeaveChatAction)($bookingId);
        return $this->success('Leave Successfully.', null);
    }
}
