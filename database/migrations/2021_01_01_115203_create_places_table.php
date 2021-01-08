<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up(): void
    {
        Schema::create("places", function (Blueprint $table): void {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("trip_id");
            $table->string("country");
            $table->string("name");
            $table->string("description");
            $table->string("city");
            $table->decimal("lng");
            $table->decimal("lat");

            $table->foreign("trip_id")->references("id")->on("trips")
                ->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("places");
    }
}
