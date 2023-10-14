<?php

namespace App\UseCases\Auth;

use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction
{
    public function __invoke($request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        ResetCodePassword::where('email', $request->email)->delete(); // Delete all old code that user send before.
        $data['code'] = mt_rand(100000, 999999);   // Generate random code
        $codeData = ResetCodePassword::create($data); // Create a new code
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code)); // Send email to user

        return response(['message' => trans('passwords.sent')], 200);
    }
}
