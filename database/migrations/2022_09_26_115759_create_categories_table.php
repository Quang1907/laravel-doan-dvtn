<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string( "name" );
            $table->string( "slug" );
            $table->mediumText( "description" );
            $table->string( "image" )->nullable();

            $table->string( "meta_title" );
            $table->string( "meta_keyword" );
            $table->mediumText( "meta_description" );

            $table->tinyInteger( "status" )->default( 0 )->commit( "1=visible, 0=hidden" );
            $table->integer("parent_id")->nullable();
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
        Schema::dropIfExists('categories');
    }
}
