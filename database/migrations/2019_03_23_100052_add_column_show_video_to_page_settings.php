<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnShowVideoToPageSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->boolean('show_video')->default(false)->after('hero_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->dropColumn('show_video');
        });
    }
}
