<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSending;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Patient;
use App\Traits\HttpResponses;
use App\UseCases\Message\FetchConnectedUserAction;
use App\UseCases\Message\FetchUserMessages;
use App\UseCases\Message\StoreMessageAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use HttpResponses;

    public function index(Request $request , $receiverId = null)
    {
        $messages = empty($receiverId) ? [] : (new FetchUserMessages)($request->user()->id , $receiverId);

        return $this->success([
            'messages' => $messages,
            'chatUsers' => (new FetchConnectedUserAction())(Auth::user()->id),
            'receiver' => Patient::find($receiverId)
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
