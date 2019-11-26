<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersNovedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_novedades', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario')->nullable('false');
            $table->unsignedBigInteger('id_novedad')->nullable('false');
            $table->primary(['id_usuario','id_novedad']);
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
        Schema::dropIfExists('users_novedades');
    }
}
