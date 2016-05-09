<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('customer_id')
                    ->unsigned()
                    ->index()
                    ->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');

            $table->string('name');

            $table->string('email')->unique();

            $table->string('password');

            $table->rememberToken();

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
        Schema::drop('users');
    }
}
