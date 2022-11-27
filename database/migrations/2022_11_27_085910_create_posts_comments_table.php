<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId( "user_id" )->references( "id" )->on( "users" )->cascadeOnDelete();
            $table->foreignId( "post_id" )->references( "id" )->on( "posts" )->cascadeOnDelete();
            $table->longText( "content" );
            $table->integer( "parent_id" )->nullable();
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
        Schema::dropIfExists('posts_comments');
    }
}
