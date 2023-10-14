<?php

namespace App\Http\Controllers\Api\Auth;


class LogoutAction
{
    public function __invoke()
    {

        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success('Successfully logged out.', null, 200);
    }
}
