<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        $user = User::all()->random();

        return [
            "user_id" => $user->id,
            "photo_id" => $user->photos()->inRandomOrder()->firstOrCreate([
                "path" =>"images/image.png",
                "name" =>"image.png",
                "user_id" => $user->id,
                    ])->id,
            "name" => $this->faker->unique()->name,
            "description" => $this->faker->randomLetter,
        ];
    }
}
