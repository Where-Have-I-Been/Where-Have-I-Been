<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            "user_id" => rand(1, 5),
            "photo_id" => Photo::query()->first()->id,
            "name" => $this->faker->unique()->name,
            "description" => $this->faker->randomLetter,
        ];
    }
}
