<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_apertura');
            $table->date('fecha_cierre');
            $table->text('requisitos');
            $table->text('adicionales');
            $table->text('presentacion');
            $table->string('horario');
            $table->string('estado')->default('abierta');         
            $table->timestamps();
            $table->bigInteger('id_asignatura');
            $table->foreign('id_asignatura')->references('id')->on('asignaturas')->onDelete('cascade');
            $table->bigInteger('id_tipo_cargo');
            $table->foreign('id_tipo_cargo')->references('id')->on('tipos_cargo')->onDelete('cascade');
            $table->bigInteger('id_departamento');
            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('cascade');
            $table->bigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('asignaturas',function(Blueprint $table){
              $table->dropForeign('id_asignatura');
         });
         Schema::table('tipos_cargo',function(Blueprint $table){
              $table->dropForeign('id_tipo_cargo');
         });
         Schema::table('departamentos',function(Blueprint $table){
              $table->dropForeign('id_departamento');
         });
           Schema::table('usuarios',function(Blueprint $table){
              $table->dropForeign('id_usuario');
         });
         Schema::dropIfExists('vacantes');
    }
}
