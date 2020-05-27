<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\TaskState;
use App\Enum\TaskType;


class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', TaskType::getAllTypesId());
            $table->enum('state', TaskState::getAllStateIds());
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('chapter_id');
            $table->unsignedInteger('assignee_id')->nullable();
            $table->unsignedInteger('owner_id');
            $table->timestamps();

            $table->foreign('subject_id')
                ->references('id')->on('subjects');

            $table->foreign('chapter_id')
                ->references('id')->on('chapters');

            $table->foreign('owner_id')
                ->references('id')->on('users');

            $table->foreign('assignee_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
