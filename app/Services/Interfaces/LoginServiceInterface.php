<?php

declare(strict_types=1);

namespace App\Services\Interfaces;


interface LoginServiceInterface
{
    public function login(array $credentials): string;
}
