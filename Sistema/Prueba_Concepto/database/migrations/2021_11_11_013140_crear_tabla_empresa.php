<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut', 12)->nullable();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('correo')->nullable();

            $table->string('rl_rut',12)->nullable();
            $table->string('rl_nombre');
            $table->string('rl_paterno');
            $table->string('rl_materno')->nullable();
            $table->string('rl_telefono');
            $table->string('rl_correo'); 
            $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('empresa');
    }
}
