<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;

class PhotosSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<10; $i++){
            Photo::query()->create([
                "path" =>"images/image.png",
                "name" =>"image.png",
                "user_id" => rand(1, 5),
            ]);
        }
    }
}
