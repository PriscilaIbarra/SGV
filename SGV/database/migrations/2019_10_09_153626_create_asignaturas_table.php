<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nro');
            $table->string('descripcion');            
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->bigInteger('id_jefe_catedra_calificador')->nullable()->unsigned()->index();
            $table->foreign('id_jefe_catedra_calificador')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('users',function(Blueprint $table){
            $table->dropForeign('id_jefe_catedra_calificador');
         });
         Schema::dropIfExists('asignaturas');
    }
}


























