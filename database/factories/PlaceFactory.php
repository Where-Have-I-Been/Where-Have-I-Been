<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            "user_id" => rand(1, 5),
            "trip_id" => rand(1, 5),
            "country_id" => rand(1, 100),
            "city" => $this->faker->unique()->city,
            "name" => $this->faker->unique()->name,
            "description" => $this->faker->randomLetter,
        ];
    }
}
