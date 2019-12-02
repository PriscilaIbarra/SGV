<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruta')->nullable('false');
            $table->timestamps();
            $table->bigInteger('id_orden')->nullable()->unsigned()->index();           
            $table->foreign('id_orden')->references('id')->on('orden_meritos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_meritos',function(Blueprint $table){
            $table->dropForeign('id_orden');
       });
        Schema::dropIfExists('contancias');
    }
}
