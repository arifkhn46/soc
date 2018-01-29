<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('body');
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
            
            $table->foreign('subject_id')
                ->on('id')->references('subjects');
            $table->foreign('user_id')
                ->on('id')->references('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
