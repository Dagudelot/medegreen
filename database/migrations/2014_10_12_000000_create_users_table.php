<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('users', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });*/

        DB::statement('create table users(
            id int(255) auto_increment not null,
            name varchar(255),
            role varchar(255),
            profile_pic varchar(255),
            puntos int(255) default 0,
            email varchar(255),
            password varchar(255),
            remember_token varchar(255),
            created_at datetime,
            updated_at datetime,
            constraint pk_users PRIMARY KEY(id)
        );');
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
