<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('leave', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('empid');
           // $table->string('name')->nullable();
            $table->string('username');
            $table->string('application_id');
            $table->string('totalleave')->nullable();
            $table->string('startdate');
            $table->string('enddate');
            $table->string('start_half');
            $table->string('end_half');
            $table->string('ondate')->nullable();
            $table->string('ontime')->nullable();
            $table->string('leave_type');


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
		//
        Schema::drop('leave');

    }

}
