<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptedToFollowers extends Migration
{
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->boolean('accepted')->default(1);
        });
    }

    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropColumn('accepted');
        });
    }
}
