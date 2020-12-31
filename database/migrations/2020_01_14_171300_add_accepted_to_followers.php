<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptedToFollowers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("followers", function (Blueprint $table): void {
            $table->boolean("accepted")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("followers", function (Blueprint $table): void {
            $table->dropColumn("accepted");
        });
    }
}
