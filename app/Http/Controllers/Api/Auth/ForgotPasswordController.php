<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\UseCases\Auth\ResetPasswordAction;
use App\UseCases\Auth\ForgotPasswordAction;

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
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code)); // Send email to user

        return response(['message' => trans('passwords.sent')], 200);
    }

    public function resetNewPassword(Request $request) //Reset Password   {
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
