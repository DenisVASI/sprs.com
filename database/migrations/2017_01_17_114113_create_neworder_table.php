<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeworderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table){
            $table->increments("id")->unsigned();
            $table->string("name"); //Наименование товара
            $table->string("trackcode"); //Трэк код
            $table->string("user"); //имя пользователя, которому принадлежит заказ
            $table->string("address"); //адрес пользователя
            $table->string("tel"); //телефон
            $table->string("delivery"); //Адрес доставки
            $table->string("parcel_weight"); //вес посылки
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
