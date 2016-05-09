<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_logs', function (Blueprint $table) 
        {
            $table->increments('id');
            
            $table->integer('order_id')
                    ->unsigned()
                    ->index()
                    ->foreign('order_id')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_logs');
    }
}
