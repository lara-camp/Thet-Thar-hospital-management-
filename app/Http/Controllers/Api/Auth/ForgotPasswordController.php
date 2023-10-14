<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\Auth\ResetPasswordAction;
use App\UseCases\Auth\ForgotPasswordAction;

class  ForgotPasswordController extends Controller
{
    public function sendResetMail() //Send Mail
    {
        return (new ForgotPasswordAction)();
    }

    public function resetNewPassword() //Reset Password   {
    {
        return (new ResetPasswordAction)();
    }
}
