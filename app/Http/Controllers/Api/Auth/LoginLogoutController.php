<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\UseCases\Auth\LoginAction;
use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
>>>>>>> d3b68d11df99625e3585a0c5deba2f9983e5a7b0

class LoginLogoutController extends Controller
{
    use HttpResponses;

    //Login Method
<<<<<<< HEAD
    public function login(Request $request): JsonResponse
    {
        $result = (new LoginAction)($request->all);
        return response()->json($result);
=======
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first(), null, 422);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = auth()->user();
                $token = $user->createToken('myapptoken');
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
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), null, 500);
        }
>>>>>>> d3b68d11df99625e3585a0c5deba2f9983e5a7b0
    }

    //Logout Method
    public function logout(): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->success('Successfully logged out.', null, 200);
    }
}
