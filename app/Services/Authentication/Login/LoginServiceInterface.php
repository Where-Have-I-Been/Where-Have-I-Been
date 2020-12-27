<?php

declare(strict_types=1);

namespace App\Services\Authentication\Login;

interface LoginServiceInterface
{
    public function login(array $credentials): string;
}
