<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('customer_id')
                    ->unsigned()
                    ->index()
                    ->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');

            $table->float('subtotal', 10);

            $table->float('disccount', 10);

            $table->float('total', 10);

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
        Schema::drop('orders');
    }
}
