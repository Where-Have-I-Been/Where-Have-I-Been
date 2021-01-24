<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        return [
            "country_name" => $this->faker->country,
            "code" => $this->faker->countryCode,
            "flag_uri" => $this->faker->countryCode,
        ];
    }
}
