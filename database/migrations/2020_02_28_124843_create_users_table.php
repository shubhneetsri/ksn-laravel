<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->increments('id');
            
            /**
             * 0 => Admin
             * 1 => Student
             * 2 => Staff
             */
            $table->enum('user_type', ['0', '1', '2'])->default('1');
            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->string('email')->unique();
            $table->string('phonenumber', 20)->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->date('dob');
            $table->string('address');
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->enum('status', ['0', '1', '2'])->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
