<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;


    public function definition()
    {
        /** @var Hasher $hash */
        $hash = app(Hasher::class);

        return [
            "email" => $this->faker->unique()->safeEmail,
            "email_verified_at" => now(),
            "password" => $hash->make("password"),
        ];
    }
}
