<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    public function up(): void
    {
        Schema::create("users_profiles", function (Blueprint $table): void {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("user_id");
            $table->foreignUuid("country_id")->nullable()->default(null);
            $table->foreignUuid("photo_id")->nullable()->default(null);

            $table->foreign("user_id")->references("id")->on("users")
                ->onDelete("cascade");

            $table->string("name")->default("");
            $table->string("description")->default("");
            $table->string("gender")->default("");
            $table->date("birth_date")->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("users_profiles");
    }
}
