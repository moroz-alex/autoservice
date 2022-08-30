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
        Schema::create('order_states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('order_id', 'order_state_order_idx');
            $table->index('state_id', 'order_state_state_idx');
            $table->index('user_id', 'order_state_user_idx');

            $table->foreign('order_id', 'order_state_order_fk')->on('orders')->references('id');
            $table->foreign('state_id', 'order_state_state_fk')->on('states')->references('id');
            $table->foreign('user_id', 'order_state_user_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_states');
    }
};
