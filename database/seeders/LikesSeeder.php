<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            $liker = User::all()->random();
            $trip = Trip::all()->random();
            $liker->like($trip);
        }
    }
}
