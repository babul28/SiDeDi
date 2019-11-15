<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_biodata', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('NIP');
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->enum('religion', ['islam', 'kristen', 'katholik', 'hindu', 'buddha', 'konghuchu']);
            $table->string('institution');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_biodata');
    }
}
