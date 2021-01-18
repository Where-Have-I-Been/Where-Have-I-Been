<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\TripFactory;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    public function run(): void
    {
        TripFactory::new()->times(150)->create();
    }
}
