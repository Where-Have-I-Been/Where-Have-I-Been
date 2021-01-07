<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<50; $i++){
            $follower = User::all()->random()->follow();
            $following = User::all()->random()->follow();
            if (!$follower->is($following)){
                $follower->follow($following);
            }
        }
    }
}
