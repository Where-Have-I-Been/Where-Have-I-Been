<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Place;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        $trip = Trip::all()->random();

        return [
            "user_id" => $trip->user_id,
            "trip_id" => $trip->id,
            "country" => $this->faker->country,
            "city" => $this->faker->unique()->city,
            "name" => $this->faker->unique()->word(),
            "description" => $this->faker->sentence,
            "lat" => rand(1, 1000) / 2,
            "lng" => rand(1, 1000) / 2,
        ];
    }
}
