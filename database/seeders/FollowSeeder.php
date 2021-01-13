<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $follower = User::all()->random();
            $following = User::all()->random();
            if (!$follower->is($following)) {
                $follower->follow($following);
            }
        }
    }
}
