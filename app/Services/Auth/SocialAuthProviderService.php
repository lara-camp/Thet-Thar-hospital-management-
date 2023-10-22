<?php


namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Str;

class SocialAuthProviderService
{
    public function handleAuthentication($user, $provider)
    {
        $newUser =  $this->store($user, $provider);
        $this->login($newUser);
        $token = $this->createToken($newUser);
        return $token;
    }


    private function store($user, $provider)
    {
        return User::updateOrCreate(
            [
                'email' => $user->getEmail(),
            ],
            [
                'provider_id' => $user->getId(),
                'provider_name' => $provider,
                'name' => $user->getName(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
            ]
        );
    }

    private function login($newUser)
    {
        return auth()->login($newUser);
    }

    public function createToken($newUser)
    {
        return $newUser->createToken('ThetTher')->plainTextToken;
    }
}
