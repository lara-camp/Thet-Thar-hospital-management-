<?php

namespace App\UseCases\Appointments;

use App\Models\Message;

class FetchBookingIdAction
{
    public function __invoke(int $senderId,int $receiverId)
    {
        $message = Message::whereIn('sender_id', [$senderId, $receiverId])->whereIn('receiver_id', [$senderId, $receiverId])->first();
        return $message->booking_id;
    }
}
