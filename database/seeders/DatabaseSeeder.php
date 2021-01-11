<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (Country::query()->get()->isEmpty()) {
            $this->call([
                CountriesSeeder::class,
            ]);
        }

        $this->call([
            UsersSeeder::class,
            PhotosSeeder::class,
            TripsSeeder::class,
            PlacesSeeder::class,
            PlacePhotosSeeder::class,
        ]);
    }
}
