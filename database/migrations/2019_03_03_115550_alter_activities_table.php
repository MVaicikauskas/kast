<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('time');

            $table->string('image')->nullable();
            $table->string('website')->nullable()->after('facebook_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
          $table->dropColumn('image');
          $table->dropColumn('website');

          $table->decimal('price', 13, 2)->default(0);
          $table->datetime('time')->nullable();
        });
    }
}
