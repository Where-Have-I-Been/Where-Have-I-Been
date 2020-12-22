<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices\LoginService;

interface LoginServiceInterface
{
    public function login(array $credentials): string;
}
