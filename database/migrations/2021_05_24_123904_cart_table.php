<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cart',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('img');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('shop_name');
            $table->string('shop_code');
            $table->string('product_info');
            $table->string('product_quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('mobile');
        
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
    }
}
