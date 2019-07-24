<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->unique();
            $table->string('first_name',120);
            $table->string('last_name',120);
            $table->string('slug',30)->unique();
            $table->string('email',191)->unique();
            $table->string('password',128);
            $table->boolean('status')->default(0);
            $table->char('gender',1)->default('s')->nullable();
            $table->integer('phone')->nullable();
            $table->string('last_login_ip',240)->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->string('session_id',100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }

}
