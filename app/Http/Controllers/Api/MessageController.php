<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSending;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Models\Message;
use App\Models\Patient;
use App\Models\User;
use App\Traits\HttpResponses;
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

        return $this->success([
            'messages' => MessageResource::collection($messages),
            'chatUsers' => (new FetchConnectedUserAction())(Auth::user()->id),
            'receiver' => $receiver,
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
}
