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
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->text('url')->nullable();
            $table->text('video_url')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();
            $table->string('status')->nullable();
            $table->string('order')->nullable();
            $table->string('type')->nullable();

            $table->string('location_id')->nullable();
            $table->string('speaker_id')->nullable();
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
