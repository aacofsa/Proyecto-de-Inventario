<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('precio_total')->unsigned();
            $table->date('fecha');
            $table->enum('tipo',['compra','venta']);
            $table->integer('factura')->nullable();
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
        Schema::dropIfExists('registro_producto');
    }
}
