<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('agent_id');
            $table->integer('merchant_id');
            $table->string('productType');
            $table->string('productName');
            $table->string('saleId');
            $table->enum('saleType',[0,1])->default(0);
            $table->enum('status',[0,1])->default(0);
            $table->decimal('money', 10, 2);
            $table->decimal('oldMoney', 10, 2);
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
        Schema::drop('goods');
    }
}
