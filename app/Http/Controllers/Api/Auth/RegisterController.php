<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function Register(Request $request){
        $request->validate([
            "name" => "required|string|max:50|min:3",
            "email" => "required|email|unique:users,email",
            "password"=>[
                "required",
                "confirmed",
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
            "success"=> true,
            "message" => "Please check your email , you email has been verified .",
        ]);
    }

    public function verify($id , $hash)
    {
        $user = User::where("id",$id)->where("email_verification_token", $hash)->first();

        if ($user) {
            $user->markEmailAsVerified();

            return Redirect::to("https://google.com");
        } else {
            return response()->json([
                'message' => 'Invalid verification link.',
            ], 400);
        }
    }
}
