<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('roman_name')->nullable();
            $table->string('number_name')->nullable();
            $table->string('teacher_id')->nullable();
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
        Schema::dropIfExists('ksn_classes');
    }
}
