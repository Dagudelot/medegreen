<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('table_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });*/

        DB::statement('create table likes(
            id int(255) auto_increment not null,
            post_id int(255),
            user_id int(255),
            created_at datetime,
            updated_at datetime,
            constraint pk_likes PRIMARY KEY(id),
            constraint fk_user_like FOREIGN KEY(user_id) REFERENCES users(id),
            constraint fk_post_like FOREIGN KEY(post_id) REFERENCES publicaciones(id)
        );');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_likes');
    }
}
