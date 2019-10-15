<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_generacion');
            $table->string('disponibilidad_horaria');
            $table->string('cv');
            $table->float('calificacion',2,2); 
            $table->bigInteger('id_vacante');
            $table->bigInteger('id_usuario');          
            $table->timestamps();
            $table->foreign('id_vacante')->references('id')->on('vacantes')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('vacantes',function(Blueprint $table){
            $table->dropForeign('id_vacante');
       });
       Schema::table('users',function(Blueprint $table){
            $table->dropForeign('id_usuario');
       });
       Schema::dropIfExists('inscripciones');
    }
}
