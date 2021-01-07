<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class PhotosSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<50; $i++){
            $user = User::all()->random();
            Photo::query()->create([
                "path" =>"images/image.png",
                "name" =>"image.png",
                "user_id" => $user->id,
            ]);
        }
    }
}
