<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildEventsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  Schema::table('events', function(Blueprint $table) {
        //         $table->integer('category_id')->unsigned();
        //          $table->foreign('category_id')
        //          ->references('id')->on('event_category')
        //          ->onDelete('cascade');
        //  }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('events', function(Blueprint $table) {
        //     $table->dropColumn('category_id');
        // });
    }
}