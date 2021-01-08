<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhotos extends Migration
{
    public function up(): void
    {
        Schema::table("photos", function (Blueprint $table): void {
            $table->primary("id");
        });
    }


    public function down(): void
    {
    }
}
