<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('avatar', 255);
            $table->string('bio', 255);
            $table->string('email', 255);
            $table->string('phone', 30);
            $table->string('website', 255);
            $table->string('facebook', 255);
            $table->string('twitter', 255);
            $table->string('linkedin', 255);
            $table->integer('event_count');
            $table->integer('status');
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('organizers');
    }
}
