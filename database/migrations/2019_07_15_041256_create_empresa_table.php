<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',200);
             $table->string('email',255);
             $table->string('ciudad',255);
               $table->string('imagen',500);
        $table->string('domicilio',500);
             $table->string('giro',200);
             $table->string('rut',15);
            $table->integer('codigo_postal');
              $table->string('fax');
             $table->integer('telefono');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
