<?php


namespace App\Services\Authentication\External;


use Laravel\Socialite\Contracts\User;

interface FacebookAuthServiceInterface
{
    public function getToken(User $socialUser, string $socialProviderName): string;
}
