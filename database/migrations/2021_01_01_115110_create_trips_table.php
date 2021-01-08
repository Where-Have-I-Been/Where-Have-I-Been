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
            $table->unsignedBigInteger("user_id");
            $table->string("name");
            $table->string("description");
            $table->foreignUuid("photo_id")->nullable()->default(null);

            $table->boolean("published")->default(false);

            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("trips");
    }
}
