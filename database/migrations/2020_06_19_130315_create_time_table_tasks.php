<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_table_tasks', function (Blueprint $table) {
            $table->id();

            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('time_table_id');
            $table->boolean('completed')->default(false);
            $table->string('comments')->nullable();
            $table->timestamps();

            $table->foreign('time_table_id')
                ->references('id')->on('time_tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_table_tasks');
    }
}
