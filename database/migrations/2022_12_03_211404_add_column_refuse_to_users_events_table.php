<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRefuseToUsersEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_events', function (Blueprint $table) {
            $table->boolean( "refuse" )->default( false );
            $table->integer( "allow_absence" )->nullable();
            $table->mediumText( "content_refuse" )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_events', function (Blueprint $table) {
            $table->dropColumn( "refuse" );
            $table->dropColumn( "allow_absence" );
            $table->dropColumn( "content_refuse" );
        });
    }
}
