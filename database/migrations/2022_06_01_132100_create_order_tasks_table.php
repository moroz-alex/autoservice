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
        Schema::create('order_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedSmallInteger('quantity');
            $table->unsignedSmallInteger('duration');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->softDeletes();

            $table->index('order_id', 'order_task_order_idx');
            $table->index('task_id', 'order_task_task_idx');

            $table->foreign('order_id', 'order_task_order_fk')->on('orders')->references('id');
            $table->foreign('task_id', 'order_task_task_fk')->on('tasks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tasks');
    }
};
