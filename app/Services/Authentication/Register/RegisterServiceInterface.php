<?php

declare(strict_types=1);

namespace App\Services\Authentication\Register;

interface RegisterServiceInterface
{
    public function register(array $credentials);
}
