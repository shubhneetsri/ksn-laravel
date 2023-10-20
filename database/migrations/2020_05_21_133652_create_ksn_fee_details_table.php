<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKsnFeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ksn_fee_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('academic_year_id')->unsigned();
            $table->integer('admission_fee')->nullable();
            $table->integer('development_fee')->nullable();
            $table->integer('other')->nullable();
            $table->integer('monthly_fee')->nullable();

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
        Schema::dropIfExists('ksn_fee_details');
    }
}
