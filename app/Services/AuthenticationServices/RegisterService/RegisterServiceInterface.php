<?php

declare(strict_types=1);

namespace App\Services\CountryService\AuthenticationServices\RegisterService;

interface RegisterServiceInterface
{
    public function register(array $credentials);
}
