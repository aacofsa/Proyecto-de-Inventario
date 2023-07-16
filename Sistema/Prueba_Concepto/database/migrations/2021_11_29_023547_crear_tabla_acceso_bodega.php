<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaAccesoBodega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso_bodega', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('email_usuario');
            $table->unsignedBigInteger('id_bodega');
            $table->boolean('activo');
            
            //$table->primary(['email_usuario','id_bodega']);
            $table->foreign('email_usuario')->references('email')->on('usuario');
            $table->foreign('id_bodega')->references('id')->on('bodega');
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
        Schema::dropIfExists('acceso_bodega');
    }
}
