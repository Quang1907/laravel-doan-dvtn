<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_events', function (Blueprint $table) {
            $table->foreignId( "user_id" )->references( "id" )->on( "users" )->onDelete( "cascade" );
            $table->foreignId( "user_create" )->references( "id" )->on( "users" )->onDelete( "cascade" );
            $table->foreignId( "event_id" )->references( "id" )->on( "events" )->onDelete( "cascade" );
            $table->boolean( "active" )->default( false );
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
        Schema::dropIfExists('users_events');
    }
}
