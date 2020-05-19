<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnStudentClassDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_student_class_details', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->enum('status', ['0', '1'])->default('1');
            $table->foreign('student_id')->references('id')->on('ksn_students')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('ksn_classes');
            $table->foreign('academic_year_id')->references('id')->on('ksn_academic_years');
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
