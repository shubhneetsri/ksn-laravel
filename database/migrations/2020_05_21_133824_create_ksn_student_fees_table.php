<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_student_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->string('admission_fee')->nullable();
            $table->string('development_fee')->nullable();
            $table->string('other_fee')->nullable();
            $table->string('fee_id')->nullable();
            $table->integer('march')->nullable();
            $table->integer('april')->nullable();
            $table->integer('may')->nullable();
            $table->integer('june')->nullable();
            $table->integer('july')->nullable();
            $table->integer('aug')->nullable();
            $table->integer('sept')->nullable();
            $table->integer('oct')->nullable();
            $table->integer('nov')->nullable();
            $table->integer('dec')->nullable();
            $table->integer('jan')->nullable();
            $table->integer('feb')->nullable();

            $table->foreign('student_id')->references('id')->on('ksn_students')->onDelete('cascade');
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
        Schema::dropIfExists('ksn_student_fees');
    }
}
