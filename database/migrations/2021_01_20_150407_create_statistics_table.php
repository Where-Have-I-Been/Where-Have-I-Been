<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create("statistics", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->json("data")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("statistics");
    }
}
