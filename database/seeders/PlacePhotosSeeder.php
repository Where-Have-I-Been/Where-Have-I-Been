<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\PlacePhoto;
use Illuminate\Database\Seeder;

class PlacePhotosSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<50; $i++){
            $place = Place::all()->random();
            PlacePhoto::query()->create([
                "place_id" =>$place->id,
                "photo_id" => $place->user->photos()->inRandomOrder()->firstOrCreate([
                    "path" =>"images/image.png",
                    "name" =>"image.png",
                    "user_id" => $place->user->id,
                ])->id,
            ]);
        }
    }
}
