<?php

namespace App\UseCases\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class VerifyAction
{
    public function __invoke($id, $hash)
    {
        $user = User::where('id', $id)->where('email_verification_token', $hash)->first();

        if ($user) {
            $user->markEmailAsVerified();

            return Redirect::to("http://localhost:3000/auth/login");
        } else {
            return response()->json([
                'message' => 'Invalid verification link.',
            ], 400);
        }
    }
}
