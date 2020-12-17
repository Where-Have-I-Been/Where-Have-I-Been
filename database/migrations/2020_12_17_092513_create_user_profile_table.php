<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    public function up()
    {
        Schema::create("users_profiles", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("user_id");

            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");

            $table->string("name")->default("");
            $table->string("description")->default("");
            $table->string("gender")->default("");
            $table->string("nationality")->default("");
            $table->date("birth_date")->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("users_profiles");
    }
}
