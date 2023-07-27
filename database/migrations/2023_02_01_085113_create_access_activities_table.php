<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->uuid('session_login_uuid');
            $table->string('ip_address')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_region')->nullable();
            $table->string('location_country')->nullable();
            $table->string('location_post_zip_code')->nullable();
            $table->string('location_latitude')->nullable();
            $table->string('location_longitude')->nullable();
            $table->string('location_timezone')->nullable();
            $table->timestamp('log_in');
            $table->timestamp('log_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_activities');
    }
};
