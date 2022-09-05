<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizes', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->integer('layout');
            $table->integer('type_id');
            $table->string('question');
            $table->string('answer');
            $table->string('feedback_correct')->nullable();
            $table->string('feedback_incorrect')->nullable();
            $table->string('feedback_try_again')->nullable();
            $table->boolean('is_feedback');
            $table->boolean('is_draft');
            $table->string('media')->nullable();
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
        Schema::dropIfExists('quizes');
    }
}
