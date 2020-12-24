<?php

declare(strict_types=1);

namespace App\Services\Authentication\Password;

use App\Models\User;
use App\Services\Authentication\BaseAuthService;
use JsonSchema\Exception\ValidationException;

class PasswordService extends BaseAuthService implements PasswordServiceInterface
{
    public function changePassword(array $data, User $user): void
    {
        if (!$this->isPasswordCorrect($user, $data["current_password"])) {
            throw new ValidationException("current password is incorrect");
        }

        $user["password"] = $this->hashes->make($data["password"]);
        $user->save();
    }
}
