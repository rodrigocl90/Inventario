<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasTemporalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('entradas_temporales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_producto');
             $table->integer('cantidad');
               $table->integer('total');
                 $table->integer('precio');
                  $table->integer('tipo_operacion');
             $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
              $table->foreign('id_producto')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
        });
        
 }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas_temporales');
    }
}
