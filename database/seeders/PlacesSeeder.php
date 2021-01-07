<?php

namespace Database\Seeders;

use Database\Factories\PlaceFactory;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
{
    public function run(): void
    {
        PlaceFactory::new()->times(100)->create();
    }
}
