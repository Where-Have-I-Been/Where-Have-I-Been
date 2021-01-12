<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesCountToTripsTable extends Migration
{

    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->integer("likes_count");
        });
    }

    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn("likes_count");
        });
    }
}
