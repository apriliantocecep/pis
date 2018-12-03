<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('old_name')->nullable();
            $table->string('old_title')->nullable();
            $table->string('extension')->nullable();
            $table->string('file')->nullable();
            $table->integer('size')->nullable();
            $table->string('size2')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('media');
    }
}
