<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentRepositorySubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_repository_subject', function (Blueprint $table) {
            $table->integer('content_repository_id')->unsigned();
            $table->integer('subject_id')->unsigned();

            $table->foreign('content_repository_id')
                ->references('id')->on('content_repositories');
            $table->foreign('subject_id')
                ->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_repository_subject');
    }
}
