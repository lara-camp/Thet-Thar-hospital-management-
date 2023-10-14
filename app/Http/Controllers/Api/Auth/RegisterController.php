<?php

namespace App\Http\Controllers\Api\Auth;

use App\UseCases\Auth\RegisterAction;
use App\UseCases\Auth\VerifyAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(): JsonResponse //Register Method
    {
        return (new RegisterAction)();
    }

    public function verify(int $id, string $hash): JsonResponse //Verify Method
    {
        return (new VerifyAction)($id, $hash);
    }
}
