<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Followers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("followers", function (Blueprint $table): void {
            $table->increments("id");

            $table->integer("followable_id");
            $table->string("followable_type");

            $table->integer("follower_id")->nullable();
            $table->string("follower_type")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("followers");
    }
}
