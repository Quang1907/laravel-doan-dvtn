<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_posts', function (Blueprint $table) {

            $table->foreignId( "category_id" )->references( "id" )->on( "categories" )->onDelete( "cascade" );
            $table->foreignId( "posts_id" )->references( "id" )->on( "posts" )->onDelete( "cascade" );

            $table->primary( ['category_id','posts_id'] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_posts');
    }
}
