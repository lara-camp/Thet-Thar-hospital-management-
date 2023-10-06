<?php

namespace App\UseCases\Message;

use App\Models\Message;

class FetchUserMessages
{
    public function __invoke(int $senderId , int $receiverId)
    {
        return Message::whereIn('sender_id',[$senderId ,$receiverId])->whereIn('receiver_id',[$senderId,$receiverId])->get();
    }
}
