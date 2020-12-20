<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up(): void
    {
        Schema::create("countries", function (Blueprint $table): void {
            $table->bigIncrements("id");
            $table->string("country_name");
            $table->string("code");
            $table->string("flag_uri");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("countries");
    }
}
