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
            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('address');
            $table->string('phonenumber', 20)->nullable();
            $table->string('image')->nullable();
            $table->date('dob')->unique();
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
