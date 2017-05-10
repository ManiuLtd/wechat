<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('good_id');
            $table->string('saleId');
            $table->string('stock');
            $table->decimal('price',10,2);
            $table->string('expDate');
            $table->integer('usedCnt')->default(0);
            $table->integer('unUsedCnt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('details');
    }
}
