<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsTableAddAdverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
			
            $table->string('advert_image_1')->nullable()->after('youtube_url');
            $table->string('advert_image_2')->nullable()->after('advert_image_1');
            $table->string('advert_image_3')->nullable()->after('advert_image_2');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
