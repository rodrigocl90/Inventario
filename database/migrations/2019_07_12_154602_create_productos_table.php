<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
              $table->unsignedInteger('id_categoria');
            $table->string('nombre',200);
            $table->string('codigo',500)->unique();
             $table->string('descripcion',500);
             $table->boolean('estado')->default(0);
              $table->string('imagen',200);
             $table->integer('stock');
             $table->unsignedInteger('precio');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
             $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
