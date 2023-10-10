<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageNotification;
use App\Events\MessageSending;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Models\Message;
use App\Models\Patient;
use App\Models\User;
use App\Traits\HttpResponses;
use App\UseCases\Appointments\FetchBookingIdAction;
use App\UseCases\Message\FetchConnectedUserAction;
use App\UseCases\Message\FetchUserMessages;
use App\UseCases\Message\StoreMessageAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use HttpResponses;

    public function index(Request $request , $receiverId = null)
    {
        $messages = empty($receiverId) ? [] : (new FetchUserMessages)(Auth::id() , $receiverId);

        $receiver = $receiverId == null ? [] : new UserResource(User::find($receiverId));
        $booking_id = $receiverId == null ? '' : (new FetchBookingIdAction)(Auth::id(), $receiverId);

        return $this->success([
            'messages' => $messages,
            'chatUsers' => (new FetchConnectedUserAction())(Auth::user()->id),
            'receiver' => $receiver,
            'booking_id' =>  $booking_id,
//            'receiver' => new PatientResource(Patient::find($receiverId))

        ]);
    }

    public function store(Request $request, ?int $receiverId = null)
    {

        $request->validate([
            'message' => 'required|string'
        ]);

        if (empty($receiverId)){
            return $this->error("Receiver's id is messing.");
        }

        try{
            $message = (new StoreMessageAction())([
                               'sender_id' => Auth::user()->id,
                               'receiver_id' => $receiverId,
                               'message' => $request->message,
                               'booking_id'=> request('booking_id')
                           ]);
            event(new MessageSending($message));
            return $this->success("Message is sent successfully.");
        }catch (\Throwable $th){
            return $this->error($th);
        }
    }

    public function testing()
    {
        $message = "Hello world!";
        event(new MessageNotification($message));
        return view('listen');
    }
}
