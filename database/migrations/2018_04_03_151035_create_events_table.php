<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->longText('description');
            $table->timestamp('start_timestamp');
            $table->timestamp('end_timestamp');
            $table->integer('type_id');
            $table->integer('access_type');
            $table->string('tickets_url', 255);
            $table->string('cover', 255);
            $table->string('cover_original', 255);
            $table->string('youtube_url', 255);
            $table->integer('venue_id');
            $table->string('email', 255);
            $table->string('phone', 50);
            $table->string('website', 255);
            $table->longText('schedule');
            $table->integer('is_sponsored');
            $table->integer('is_editor_choice');
            $table->integer('organizer_id');
            $table->integer('attending_count');
            $table->integer('pin_count');
            $table->integer('checking_count');
            $table->integer('comment_count');
            $table->string('facebook', 255);
            $table->string('twitter', 255);
            $table->string('youtube', 255);
            $table->integer('is_organizer_owner');
            $table->string('status', 255);
            $table->timestamp('status_date');
            $table->timestamp('published_at');
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
        Schema::dropIfExists('events');
    }
}
