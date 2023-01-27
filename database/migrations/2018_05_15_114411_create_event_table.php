<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
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
            $table->string('title');
            $table->string('slug');
            $table->integer('category_id');
            $table->string('excerpt');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->string('ticket_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->boolean('confirmed');
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
        Schema::dropIfExists('event');
    }
}
