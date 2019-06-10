<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*  Schema::create('table_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });*/

        DB::statement('create table comments(
            id int(255) auto_increment not null,
            user_id int(255),
            publicacion_id int(255),
            descripcion text,
            created_at datetime,
            updated_at datetime,
            constraint pk_likes PRIMARY KEY(id),
            constraint fk_user_comment FOREIGN KEY(user_id) REFERENCES users(id),
            constraint fk_publicacion_comment FOREIGN KEY(publicacion_id) REFERENCES publicaciones(id)

        );');

    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_comments');
    }
}
