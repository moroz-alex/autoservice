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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('vendor');
            $table->string('model');
            $table->year('year')->nullable();
            $table->string('number')->nullable();
            $table->string('vin')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->index('user_id', 'car_user_idx');
            $table->foreign('user_id', 'car_user_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
