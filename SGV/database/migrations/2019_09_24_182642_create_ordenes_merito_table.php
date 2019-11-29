<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesMeritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_meritos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado')->default('En Desarrollo');
            $table->integer('numero')->nullable();
            $table->bigInteger('id_jefe_catedra')->nullable()->unsigned()->index();
            $table->timestamps();
            $table->foreign('id_jefe_catedra')->references('id')->on('users')->onDelete('cascade');
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
              $table->dropForeign('id_jefe_catedra');
         });
        Schema::dropIfExists('orden_meritos');
    }
}
