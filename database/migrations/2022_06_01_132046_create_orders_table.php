<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedSmallInteger('duration');
            $table->unsignedInteger('price');
            $table->boolean('is_confirmed');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_done');
            $table->boolean('is_paid');
            $table->timestamps();

            $table->softDeletes();

            $table->index('car_id', 'order_car_idx');
            $table->index('user_id', 'order_user_idx');

            $table->foreign('car_id', 'order_car_fk')->on('cars')->references('id');
            $table->foreign('user_id', 'order_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
