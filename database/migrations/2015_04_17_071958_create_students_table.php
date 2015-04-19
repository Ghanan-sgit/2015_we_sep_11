<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('students', function(Blueprint $table)
        {
            $table->increments('id',true);
            $table->string('reg_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('contact');
            $table->string('password',60);
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
        Schema::drop('students');
	}

}
