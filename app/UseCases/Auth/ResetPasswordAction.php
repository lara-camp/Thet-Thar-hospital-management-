<?php

namespace App\UseCases\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Password;

class ResetPasswordAction
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(5)->letters()
            ]
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->email_verification_token = Str::uuid()->toString();

        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($user));

        return response()->json([
            'success' => true,
            'message' => 'Please check your email , you email has been verified .',
        ]);
    }
}
