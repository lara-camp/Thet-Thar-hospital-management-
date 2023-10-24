<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\Auth\SocialAuthProviderService;

class ProviderServiceController extends Controller
{
    protected $socialAuthService;


    public function __construct(SocialAuthProviderService $socialAuthService)
    {
        $this->socialAuthService = $socialAuthService;
    }

    public function redirectToGoogle($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleGoogleCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user(); // Call the handleAuthentication method of googleAuthService
        $token = $this->socialAuthService->handleAuthentication($user, $provider);
        $cookie = cookie('ThetThar', $token, 60 * 24); // 24 hours expiration
        //  $redirectUrl = 'http://localhost:3000/auth/login?id=' . auth()->user()->id . '&accessToken=' . $token . '&name=' . auth()->user()->name . '&role=' . auth()->user()->role;
        $redirectUrl = config('frontendUrl') . '/auth/login?accessToken=' . $token;
        return redirect()->away($redirectUrl)->withCookie($cookie);
    }
}
