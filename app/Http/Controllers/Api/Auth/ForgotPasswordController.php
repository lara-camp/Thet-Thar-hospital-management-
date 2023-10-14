<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\Auth\ResetPasswordAction;
use App\UseCases\Auth\ForgotPasswordAction;
use Illuminate\Http\Request;

class  ForgotPasswordController extends Controller
{
    public function sendResetMail(Request $request) //Send Mail
    {
        return (new ForgotPasswordAction)($request);
    }

    public function resetNewPassword(Request $request) //Reset Password   {
    {
        return (new ResetPasswordAction)();
    }
}
