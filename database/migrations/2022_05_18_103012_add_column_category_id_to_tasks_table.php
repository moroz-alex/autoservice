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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('title');

            $table->index('category_id', 'task_category_idx');
            $table->foreign('category_id', 'task_category_fk')->on('categories')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('task_category_fk');
            $table->dropIndex('task_category_idx');
            $table->dropColumn('category_id');
        });
    }
};
