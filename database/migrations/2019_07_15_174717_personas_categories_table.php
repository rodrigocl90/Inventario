<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',200);
            $table->string('documento',200)->default(0);
            $table->string('direccion',500);
            $table->string('giro',500)->nullable();
             $table->string('numero',20);
             $table->integer('telefono')->nullable();
             $table->string('email',191);
              $table->integer('tipo');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('personas');
    }
}
