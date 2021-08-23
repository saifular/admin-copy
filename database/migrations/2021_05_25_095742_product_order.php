<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('shop_name');
            $table->string('shop_code');
            $table->string('product_info');
            $table->string('product_quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('mobile');
            $table->string('name');
            $table->string('payment_method');
            $table->string('delivery_address');
            $table->string('city');
            $table->string('delivery_charge');
            $table->string('order_date');
            $table->string('order_time');
            $table->string('order_status');
        
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
