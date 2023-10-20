<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_students', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('father_name',50)->nullable();
            $table->string('mother_name',50)->nullable();
            $table->enum('caste', ['GEN', 'SC', 'ST','OBC'])->nullable();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('admission_class_id')->unsigned();
            $table->string('reg_number')->nullable();
            $table->string('current_address',255)->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admission_class_id')->references('id')->on('ksn_classes');
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
        Schema::dropIfExists('ksn_students');
    }
}
