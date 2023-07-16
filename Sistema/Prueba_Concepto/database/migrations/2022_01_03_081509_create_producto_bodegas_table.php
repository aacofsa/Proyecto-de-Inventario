<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_bodegas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stock');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_bodega');
      

            $table->foreign('id_producto')->references('id')->on('producto');
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
        Schema::dropIfExists('producto_bodegas');
    }
}
