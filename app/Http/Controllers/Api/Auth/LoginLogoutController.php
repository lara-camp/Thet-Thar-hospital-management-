<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\UseCases\Auth\LoginAction;
use App\Http\Controllers\Controller;

class LoginLogoutController extends Controller
{
    use HttpResponses;

    //Login Method
    public function login(Request $request): JsonResponse
    {
        $result = (new LoginAction)($request);
        return response()->json($result);
    }

    //Logout Method
    public function logout(): JsonResponse
    {
        return (new LogoutAction)();
    }
}
