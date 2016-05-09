<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table)
        {
            $table->integer('order_id')
                    ->unsigned()
                    ->index()
                    ->foreign('order_id')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');

            $table->string('sku_id', 100)
                    ->index()
                    ->foreign('sku_id')
                    ->references('id')
                    ->on('skus')
                    ->onDelete('cascade');

            $table->primary(['order_id', 'sku_id']);

            $table->integer('qty')->default(1);

            $table->float('subtotal', 10);

            $table->float('disccount', 10);

            $table->float('total', 10);
            
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
        Schema::drop('order_details');
    }
}
