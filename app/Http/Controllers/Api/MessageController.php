<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Events\MessageSending;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\UseCases\Message\FetchUserMessages;
use App\UseCases\Message\StoreMessageAction;
use App\UseCases\Message\FetchConnectedUserAction;
use App\UseCases\Appointments\FetchBookingIdAction;

class MessageController extends Controller
{
    use HttpResponses;

    public function index(Request $request, $receiverId = null)
    {
        $messages = empty($receiverId) ? [] : (new FetchUserMessages)(Auth::id(), $receiverId);

        $receiver = $receiverId == null ? [] : new UserResource(User::find($receiverId));
        $booking_id = $receiverId == null ? '' : (new FetchBookingIdAction)(Auth::id(), $receiverId);

        return $this->success([
            'messages' => $messages,
            'chatUsers' => (new FetchConnectedUserAction())(Auth::user()->id),
            'receiver' => $receiver,
            'booking_id' =>  $booking_id,
        ]);
    }


    public function store(Request $request , $receiverId = null)
    {
        // return [
        //     'sender_id' => Auth::user()->id,
        //     'receiver_id' => $receiverId,
        //     'message' => $request->message,
        //     'booking_id' => $request->booking_id
        // ];
        try {
            $message = (new StoreMessageAction())([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $receiverId,
                'message' => $request->message,
                'booking_id' => $request->booking_id
            ]);

            event(new MessageSending($message));
            return $this->success("Message is sent successfully.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
