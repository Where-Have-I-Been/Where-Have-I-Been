<?php

declare(strict_types=1);

namespace App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\LoginService;

interface LoginServiceInterface
{
    public function login(array $credentials): string;
}
