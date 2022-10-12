<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phonenumber', 10)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string("avata")->nullable();
            $table->string('password')->nullable();
            $table->foreignId( "role_id" )->default( 3 )->constrained();
            $table->boolean("admin")->default(false);
            $table->boolean("is_active")->default(false);
            $table->boolean("manager")->nullable();
            $table->string('token', 5)->nullable();

            $table->string( "google_id" )->nullable();

            $table->string('github_id')->nullable();
            $table->string('auth_type')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
