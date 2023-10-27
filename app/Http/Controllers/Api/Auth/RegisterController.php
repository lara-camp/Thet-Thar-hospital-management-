<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse //Register Method
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->email_verification_token = Str::uuid()->toString();

        $user->save();

        Mail::to($user->email)->queue(new VerificationEmail($user));

        return response()->json([
            'success' => true,
            'message' => 'Please check your email , you email has been verified .',
        ]);
    }

    public function verify(int $id, string $hash) //Verify Method
    {
        $user = User::where('id', $id)->where('email_verification_token', $hash)->first();

        if ($user) {
            $user->markEmailAsVerified();

            return Redirect::to(env('FRONTEND_URL') . "/auth/login");
        } else {
            return response()->json([
                'message' => 'Invalid verification link.',
            ], 400);
        }
    }
}
