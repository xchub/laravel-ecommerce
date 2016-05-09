<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus', function (Blueprint $table)
        {
            $table->string('id', 50)
                    ->index()
                    ->primary('id');

            $table->integer('product_id')
                    ->unsigned()
                    ->index()
                    ->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');

            $table->boolean('main')->default(0);

            $table->float('before_price', 10)->default(0);

            $table->float('price', 10)->default(0);

            $table->integer('stock');

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
        Schema::drop('skus');
    }
}
