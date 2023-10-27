<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class  ForgotPasswordController extends Controller
{
    public function sendResetMail(Request $request) //Send Mail
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        ResetCodePassword::where('email', $request->email)->delete(); // Delete all old code that user send before.
        $data['code'] = mt_rand(100000, 999999);   // Generate random code
        $codeData = ResetCodePassword::create($data); // Create a new code
        Mail::to($request->email)->queue(new SendCodeResetPassword($codeData->code)); // Send email to user

        return response(['message' => trans('passwords.sent')], 200);
    }

    public function resetNewPassword(Request $request) //Reset Password   {
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update($request->only('password'));

        // delete current code
        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }
}
