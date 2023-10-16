<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\UseCases\Auth\LoginAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginLogoutController extends Controller
{
    use HttpResponses;

    //Login Method
    public function login(Request $request): JsonResponse
    {
        $result = (new LoginAction)($request->all);
        return response()->json($result);
    }

    //Logout Method
    public function logout(): JsonResponse
    {
        return (new LogoutAction)();
    }
}
