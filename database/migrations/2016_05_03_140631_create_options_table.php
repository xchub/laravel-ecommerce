<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) 
        {
            $table->increments('id');
            
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

            $table->string('title', 100);

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
        Schema::drop('options');
    }
}
