<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Blockers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("blockers", function (Blueprint $table): void {
            $table->increments("id");

            $table->integer("blockable_id");
            $table->string("blockable_type");

            $table->integer("blocker_id")->nullable();
            $table->string("blocker_type")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("blockers");
    }
}
