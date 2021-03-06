<?php

declare(strict_types=1);

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

abstract class BaseAuthService
{
    protected Hasher $hashes;

    public function __construct(Hasher $hashes)
    {
        $this->hashes = $hashes;
    }

    protected function isPasswordCorrect(User $user, string $password): bool
    {
        return $this->hashes->check($password, $user->password);
    }
}
