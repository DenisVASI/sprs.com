<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('registration', function (Blueprint $table){
            $table->increments("id")->unsigned();
            $table->string("email")->nullable();
            $table->string("password")->nullable();
            $table->string("type")->default("user");
            $table->string("surname")->nullable();
            $table->string("name")->nullable();
            $table->string("login")->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('posts');
    }
}
