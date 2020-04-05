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
            $table->integer('academic_year_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->string('reg_number')->nullable();
            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('address');
            $table->string('phonenumber', 20)->nullable();
            $table->string('image')->nullable();
            $table->date('dob');
            $table->enum('status', ['0', '1', '2'])->default('1');
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
        Schema::dropIfExists('ksn_students');
    }
}
