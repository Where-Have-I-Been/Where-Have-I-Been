<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Likers extends Migration
{
    public function up(): void
    {
        Schema::create("likers", function (Blueprint $table): void {
            $table->bigIncrements("id");

            $table->integer("likeable_id");
            $table->string("likeable_type");

            $table->integer("liker_id")->nullable();
            $table->string("liker_type")->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("likers");
    }
}
