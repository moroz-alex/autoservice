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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->dateTime('start_time');
            $table->unsignedInteger('duration');
            $table->unsignedBigInteger('master_id');
            $table->timestamps();

            $table->softDeletes();

            $table->index('order_id', 'schedule_order_idx');
            $table->index('master_id', 'schedule_master_idx');

            $table->foreign('order_id', 'schedule_order_fk')->on('orders')->references('id');
            $table->foreign('master_id', 'schedule_master_fk')->on('masters')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
