<?php

declare(strict_types=1);

namespace App\Services\Interfaces;


interface RegisterServiceInterface
{
    public function register(array $credentials);
}
