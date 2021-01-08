<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlacePhoto extends Migration
{
    public function up(): void
    {
        Schema::create("place_photo", function (Blueprint $table): void {
            $table->string("photo_id")
                ->nullable(false);
            $table->unsignedBigInteger("place_id");
            $table->foreign("place_id")
                ->references("id")
                ->on("places")
                ->onDelete("cascade");
            $table->foreign("photo_id")
                ->references("id")
                ->on("photos")
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("place_photo");
    }
}
