<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYoutubeColumnsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
			
            $table->string('youtube_url')->nullable()->after('image');
			$table->string('youtube_main')->nullable()->after('youtube_url');
			
        });
		
		


		
		
		
    }
	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('posts', function (Blueprint $table) {
            //
        //});
    }
}
