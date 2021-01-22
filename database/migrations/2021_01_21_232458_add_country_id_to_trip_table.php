<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToTripTable extends Migration
{
    public function up(): void
    {
        Schema::table("trips", function (Blueprint $table): void {
            $table->unsignedBigInteger("country_id")->nullable();
            $table->foreign("country_id")->references("id")->on("countries");
        });
    }

    public function down(): void
    {
        Schema::table("trips", function (Blueprint $table): void {
            $table->dropColumn("country_id");
        });
    }
}
