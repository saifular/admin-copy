<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_review',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('mobile');
            $table->string('reviewer_photo')->nullable();
            $table->string('reviewer_name');
            $table->string('reviewer_rating');
            $table->text('reviewer_comments');
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
