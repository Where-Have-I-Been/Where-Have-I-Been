<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Http\Requests\RegisterRequest;

interface AppRegisterServiceInterface
{
    public function register(RegisterRequest $request);
}
