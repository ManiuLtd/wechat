<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsedordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usedorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('detail_id');
            $table->string('reqId');
            $table->string('phone');
            $table->string('saleId');
            $table->string('goodId');
            $table->string('type');
            $table->integer('error_code');
            $table->enum('status',[0,1,2])->default(0); //0失败 1支付成功
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
        Schema::drop('usedorders');
    }
}
