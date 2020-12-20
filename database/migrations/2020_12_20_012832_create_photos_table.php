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
            $table->string("path");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("photos");
    }
}
