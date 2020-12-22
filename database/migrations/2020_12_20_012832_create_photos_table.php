<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    public function up(): void
    {
        Schema::create("photos", function (Blueprint $table): void {
            $table->uuid("id");
            $table->unsignedBigInteger("user_id");

            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");

            $table->string("path");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("photos");
    }
}
