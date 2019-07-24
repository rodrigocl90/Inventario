<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_operaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_operacion');
            $table->unsignedInteger('id_producto');
             $table->integer('cantidad');
            $table->integer('precio_unitario');
              $table->integer('tipo_operacion');
             $table->foreign('id_operacion')->references('id')->on('operaciones')->onDelete('cascade')->onUpdate('cascade');
              $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
     });}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_operaciones');
    }
}
