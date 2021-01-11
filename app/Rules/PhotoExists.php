<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class PhotoExists implements Rule
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        return $this->user->photos()->firstWhere("id", $value) !== null;
    }

    public function message()
    {
        return "The photo does not exist.";
    }
}
