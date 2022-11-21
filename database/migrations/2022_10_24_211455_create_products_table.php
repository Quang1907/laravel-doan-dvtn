<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId( "category_id" )->references( "id" )->on( "category_products" )->onDelete( "cascade" );
            $table->string( "name" );
            $table->string( "slug" );
            $table->string( "brand" )->nullable();
            $table->string( "small_description" )->nullable();
            $table->longText( "description" );

            $table->integer( "original_price" );
            $table->integer( "selling_price" );
            $table->integer( "quantity" );
            $table->boolean( "trending" )->default( false )->commit( "1=trending, 0=not-trending" );
            $table->boolean( "status" )->default( false )->commit( "1=show, 0=visible" );

            $table->string( "meta_title" )->nullable();
            $table->mediumText( "meta_keyword" )->nullable();
            $table->mediumText( "meta_description" )->nullable();

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
        Schema::dropIfExists('products');
    }
}
