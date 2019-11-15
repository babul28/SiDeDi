<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('value');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
