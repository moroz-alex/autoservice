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
        Schema::create('master_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->softDeletes();

            $table->index('master_id', 'master_task_master_idx');
            $table->index('task_id', 'master_task_taskr_idx');

            $table->foreign('master_id', 'master_task_master_fk')->on('masters')->references('id');
            $table->foreign('task_id', 'master_task_task_fk')->on('tasks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_tasks');
    }
};
