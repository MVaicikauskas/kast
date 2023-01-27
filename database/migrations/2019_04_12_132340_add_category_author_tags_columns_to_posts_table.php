<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryAuthorTagsColumnsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
          $table->string('author')->nullable()->after('id');

          $table->string('category_id')->nullable()->after('slug');
          // $table->foreign('category_id')
          //   ->references('id')->on('post_categories')
          //   ->onUpdate('cascade')->onDelete('set null');

          $table->text('tags')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('category_id');
            $table->dropColumn('tags');
        });
    }
}
