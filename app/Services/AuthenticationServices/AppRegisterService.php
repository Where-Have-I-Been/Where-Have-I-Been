<?php

declare(strict_types=1);

namespace App\Services\AuthenticationServices;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\Interfaces\AppRegisterServiceInterface;

class AppRegisterService implements AppRegisterServiceInterface
{
    public function register(RegisterRequest $request): void
    {
        $input = $request->validated();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $user->save();
    }
}
