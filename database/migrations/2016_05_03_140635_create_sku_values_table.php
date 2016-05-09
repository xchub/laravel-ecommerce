<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkuValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_values', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('sku_id')
                    ->index()
                    ->foreign('sku_id')
                    ->references('id')
                    ->on('skus')
                    ->onDelete('cascade');

            $table->integer('product_id')
                    ->unsigned()
                    ->index()
                    ->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

            $table->integer('variant_id')
                    ->unsigned()
                    ->index()
                    ->foreign('variant_id')
                    ->references('id')
                    ->on('variants')
                    ->onDelete('cascade');

            $table->integer('option_id')
                    ->unsigned()
                    ->index()
                    ->foreign('option_id')
                    ->references('id')
                    ->on('options')
                    ->onDelete('cascade');

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
        Schema::drop('sku_values');
    }
}
