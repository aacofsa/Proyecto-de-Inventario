<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBodega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_comuna');
            $table->unsignedBigInteger('id_empresa');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('direccion');
            $table->string('correo_encargado')->nullable()->default('NULL');
            $table->string('telefono_encargado')->nullable()->default('NULL');
            $table->string('hora_funcionamiento')->nullable()->default('NULL');
            $table->foreign('id_empresa')->references('id')->on('empresa');
            $table->foreign('id_comuna')->references('id')->on('comuna');
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
        Schema::dropIfExists('bodega');
    }
}
