<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId( "user_id" )->references( "id" )->on( "users")->cascadeOnDelete();;
            $table->foreignId( "product_id" )->references( "id" )->on( "products")->cascadeOnDelete();
            $table->bigInteger( "product_color_id" )->nullable();
            $table->bigInteger( "quantity" );
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
        Schema::dropIfExists('carts');
    }
}
