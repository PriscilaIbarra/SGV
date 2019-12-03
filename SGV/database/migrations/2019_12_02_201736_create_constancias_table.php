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
        Schema::create('constancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruta')->nullable('false');
            $table->timestamps();
            $table->bigInteger('id_orden')->nullable()->unsigned();           
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
        Schema::dropIfExists('constancias');
    }
}
