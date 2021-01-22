<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    public function up(): void
    {
        Schema::create("statistics", function (Blueprint $table): void {
            $table->bigIncrements("id");
            $table->json("data")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("statistics");
    }
}
