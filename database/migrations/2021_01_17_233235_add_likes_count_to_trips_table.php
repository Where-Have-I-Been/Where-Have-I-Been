<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesCountToTripsTable extends Migration
{
    public function up(): void
    {
        Schema::table("trips", function (Blueprint $table): void {
            $table->integer("likes_count")->default(0);
        });
    }


    public function down(): void
    {
        Schema::table("trips", function (Blueprint $table): void {
            $table->dropColumn("likes_count");
        });
    }
}
