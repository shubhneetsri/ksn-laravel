<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_student_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_id');
            $table->integer('student_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->string('academic_year');
            $table->enum('status', ['0', '1', '2'])->default('1'); 

            $table->foreign('student_id')->references('id')->on('ksn_students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('ksn_classes')->onDelete('cascade');

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
        Schema::dropIfExists('ksn_student_registrations');
    }
}
