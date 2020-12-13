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
        $user = new User();
        $user->email = $request->__get("email");
        $user->password = bcrypt($request->__get("password"));
        $user->save();
    }
}
