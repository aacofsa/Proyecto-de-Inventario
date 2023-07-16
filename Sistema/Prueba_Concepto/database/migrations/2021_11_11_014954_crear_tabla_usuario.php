<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->unsignedBigInteger('id_empresa');
            $table->string('rut',12)->nullable();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->materno();
            $table->date('fecha_nacimiento');
            $table->string('clave');
            $table->string('foto');
            $table->enum('rol', ['superadmin','admin', 'empleado']);
            $table->boolean('activo')->default(true);
            $table->foreign('id_empresa')->references('id')->on('empresa');
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
        Schema::dropIfExists('usuario');
    }
}
