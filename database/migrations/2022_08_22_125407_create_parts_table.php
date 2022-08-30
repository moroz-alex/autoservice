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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('code', 20)->nullable();
            $table->string('title');
            $table->unsignedInteger('price');
            $table->unsignedSmallInteger('quantity');
            $table->timestamps();

            $table->index('order_id', 'parts_order_idx');
            $table->foreign('order_id', 'parts_order_fk')->on('orders')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
};
