<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginLogoutController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken('ThetTher');
            return $this->success('Successfully logged in.', [
                'token' => $token->plainTextToken,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                ]
            ], 200);
        }

        return $this->error('Your credentials is not correct.', null, 422);
    }

    //Logout Method
    public function logout(): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success('Successfully logged out.', null, 200);
    }
}
