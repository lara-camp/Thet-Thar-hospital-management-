<?php


namespace App\UseCases\Message;


use App\Models\Message;
use App\Traits\HttpResponses;

class StoreMessageAction
{

    public function __invoke(array $data): Message
    {
        return Message::create($data);
//        return $data;
    }

}
