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
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('vendor');
            $table->dropColumn('model');

            $table->unsignedBigInteger('model_id')->after('user_id');

            $table->index('model_id', 'car_model_idx');
            $table->foreign('model_id', 'car_model_fk')->on('car_models')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('car_model_fk');
            $table->dropIndex('car_model_idx');

            $table->dropColumn('model_id');

            $table->string('vendor')->after('user_id');
            $table->string('model')->after('user_id');
        });
    }
};
