<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    public function up(): void
    {
        Schema::create("trips", function (Blueprint $table): void {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("description");
            $table->boolean("published")
                ->default(false);
            $table->timestamps();

            $table->unsignedBigInteger("user_id");
            $table->foreignUuid("photo_id")
                ->nullable()
                ->default(null);
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("trips");
    }
}
