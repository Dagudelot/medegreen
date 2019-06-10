<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('table_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });*/

        DB::statement('create table media(
            id int(255) auto_increment not null,
            publicacion_id int(255) not null,
            link varchar(255) not null,
            mime varchar(255) not null,
            name varchar(255) not null,
            created_at datetime,
            updated_at datetime,
            constraint pk_media primary key(id),
            constraint fk_media_publicacion FOREIGN KEY(publicacion_id) REFERENCES publicaciones(id)
        );');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_media');
    }
}
