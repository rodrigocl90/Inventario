<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('operaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_persona');
            $table->integer('tipo_documento');
            $table->integer('numero_documento');
            $table->unsignedInteger('id_user');
            $table->integer('tipo_pago');
            $table->integer('tipo_operacion');
            $table->date('fecha_emision');
            $table->boolean('estado')->default(0);
             $table->string('notas',501)->nullable();
            $table->integer('neto');
            $table->integer('iva');
            $table->integer('total');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

             $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
              $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones');
    }
}
