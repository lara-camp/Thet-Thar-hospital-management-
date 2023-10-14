<?php

namespace App\UseCases\Auth;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginAction
{
    use HttpResponses;

    public function __invoke($request)
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
    }
}
