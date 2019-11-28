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
           // $table->unsignedBigInteger('id_inscripcion')->nullable('false');
            $table->primary(['id_usuario','id_novedad','id_inscripcion']);
            //$table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('id_novedad')->references('id')->on('novedads')->onDelete('cascade');
           // $table->foreign('id_inscripcion')->references('id')->on('inscripciones')->onDelete('cascade');
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

      /* Schema::table('users',function(Blueprint $table){
            $table->dropForeign('id_usuario');
       });
        Schema::table('novedads',function(Blueprint $table){
            $table->dropForeign('id_novedad');
       });
        Schema::table('inscripciones',function(Blueprint $table){
            $table->dropForeign('id_inscripcion');
       });*/

       Schema::dropIfExists('users_novedades');
    }
}
