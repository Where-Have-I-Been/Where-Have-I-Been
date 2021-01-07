<?php


namespace Database\Seeders;


use Database\Factories\TripFactory;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    public function run(): void
    {
        TripFactory::new()->times(50)->create();
    }
}
