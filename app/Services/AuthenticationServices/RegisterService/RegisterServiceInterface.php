<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices\RegisterService;

interface RegisterServiceInterface
{
    public function register(array $credentials);
}
