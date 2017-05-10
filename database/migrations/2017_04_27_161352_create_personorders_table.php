<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('order_num');
            $table->string('phone');
            $table->integer('good_id');
            $table->decimal('price',10,2);
            $table->enum('status',[0,1,2,3])->default(0);
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
        Schema::drop('personorders');
    }
}
