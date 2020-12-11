<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Http\Requests\LoginRequest;

interface AppLoginServiceInterface
{
    public function login(LoginRequest $request): string;
}
