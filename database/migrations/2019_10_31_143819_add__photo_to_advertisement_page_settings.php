<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToAdvertisementPageSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('advertisement_page_settings', function (Blueprint $table) {
        //     $table->string('Photo')->nullable()->after('Text');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('advertisement_page_settings', function (Blueprint $table) {
        //     //
        // });
    }
}
