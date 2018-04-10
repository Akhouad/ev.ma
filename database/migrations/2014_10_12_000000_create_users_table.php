<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('password');
            $table->string('avatar');
            $table->string('phone');
            $table->integer('city_id');
            $table->string('facebook_id');
            $table->string('facebook_access_token');
            $table->string('confirm_email_token');
            $table->string('access_token');
            $table->integer('is_organizer');
            $table->integer('is_certified_organizer');
            $table->integer('is_speaker');
            $table->integer('is_admin');
            $table->integer('verified');
            $table->integer('disabled');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
