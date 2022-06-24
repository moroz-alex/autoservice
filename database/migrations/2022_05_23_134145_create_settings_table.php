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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('');
            $table->string('address')->nullable();
            $table->string('phones')->nullable();
            $table->string('work_days')->nullable();
            $table->time('schedule_start')->nullable();
            $table->time('schedule_end')->nullable();
            $table->string('api_key')->default('');
            $table->timestamp('models_updated_at')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
