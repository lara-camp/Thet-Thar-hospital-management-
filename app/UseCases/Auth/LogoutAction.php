<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\HttpResponses;

class LogoutAction
{
    use HttpResponses;
    public function __invoke()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success('Successfully logged out.', null, 200);
    }
}
