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
            $table->dateTime('fecha_creacion_vacante');
            $table->string('estado')->default('abierta');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_cierre');
            $table->string('requisitos_puesto');
            $table->string('adicionales');
            $table->string('presentacion');
            $table->dateTime('fecha_apertura');
            $table->string('horario');
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
        Schema::dropIfExists('vacantes');
    }
}
