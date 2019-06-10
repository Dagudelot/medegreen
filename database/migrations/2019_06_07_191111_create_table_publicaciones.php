<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('table_publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });*/

        DB::statement('create table publicaciones(
            id int(255) auto_increment not null,
            user_id int(255) not null,
            descripcion text,
            created_at datetime,
            updated_at datetime,
            constraint pk_publicacion PRIMARY KEY(id),
            constraint fk_user_post FOREIGN KEY(user_id) REFERENCES users(id)
        );');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_publicaciones');
    }
}
