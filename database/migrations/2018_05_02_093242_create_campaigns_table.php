<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('subject', 255);
            $table->longText('message');
            $table->tinyInteger('send_to');
            $table->tinyInteger('status')->default(0);
            $table->integer('send_count');
            $table->integer('delivered_count');
            $table->integer('organizer_id');
            $table->integer('user_id');
            $table->integer('event_id');
            $table->string('ip_address');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
