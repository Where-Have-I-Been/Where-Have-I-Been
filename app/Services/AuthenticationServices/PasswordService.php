<?php


namespace App\Services\AuthenticationServices;


use _HumbugBoxf99c1794c57d\Nette\Schema\ValidationException;
use App\Models\User;
use App\Services\Interfaces\PasswordServiceInterface;

class PasswordService extends BaseAuthService implements PasswordServiceInterface
{

    public function changePassword(array $data, User $user): void
    {
        if (!$this->isPasswordCorrect($user, $data["current_password"])){
            throw new ValidationException("current password is incorrect");
        }

        $user["password"] = $this->hashes->make($data["password"]);
        $user->save();
    }
}
