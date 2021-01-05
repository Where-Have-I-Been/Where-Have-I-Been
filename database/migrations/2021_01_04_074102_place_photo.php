<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlacePhoto extends Migration
{

    public function up()
    {
        Schema::create("placePhotos", function (Blueprint $table) {
            $table->foreignUuid("photo_id")->nullable(false);
            $table->unsignedBigInteger("place_id");
            $table->foreign("place_id")->references("id")->on("places")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists("placePhotos");
    }
}
