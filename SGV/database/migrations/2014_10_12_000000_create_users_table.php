<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('dni');
            $table->string('telefono');
            $table->bigInteger('id_tipo_usuario');              
            $table->rememberToken();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('id_tipo_usuario')->references('id')->on('tipos_usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('tipos_usuarios',function(Blueprint $table){
            $table->dropForeign('id_tipo_usuario');
       });

       Schema::dropIfExists('users');
    }
}
