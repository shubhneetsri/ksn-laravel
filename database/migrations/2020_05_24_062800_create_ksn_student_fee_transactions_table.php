<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnStudentFeeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_student_fee_transactions', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('student_fee_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->enum('month', ['march', 'april', 'may','june','july','aug','sept','oct','nov','dec','jan','feb'])->nullable();
            $table->enum('method', ['COD', 'ONLINE'])->nullable();
            $table->enum('type', ['ADD', 'DEV','OTHER','MONTHLY']);
            $table->integer('fee')->nullable();
            $table->integer('late_fee')->nullable();
            $table->string('given_by',30)->nullable();
            $table->string('recieved_by',30)->nullable();
            $table->date('recieved_on');

            $table->foreign('student_id')->references('id')->on('ksn_students')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('ksn_academic_years'); 
            $table->foreign('student_fee_id')->references('id')->on('ksn_student_fees')->onDelete('cascade');
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
        Schema::dropIfExists('ksn_student_fee_transactions');
    }
}
