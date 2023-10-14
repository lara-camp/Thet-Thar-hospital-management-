<?php


namespace App\UseCases\Message;


use App\Models\Message;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Log;

class StoreMessageAction
{

    public function __invoke(array $data): Message
    {
        return Message::create($data);
    }
}
