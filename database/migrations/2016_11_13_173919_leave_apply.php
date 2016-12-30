<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeaveApply extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        //
        Schema::create('leaveapply', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('empid');
            $table->string('name')->nullable();
            $table->string('username');
            $table->string('leave_type');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_half');
            $table->string('end_half');
            $table->string('number');
            $table->string('rejreason')->nullable();
            $table->string('reason');
            $table->string('totalleave')->nullable();
            $table->string('status');
            $table->string('ondate')->nullable();
            $table->string('ontime')->nullable();

            //$table->string('dates')->nullable();
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
        Schema::drop('leaveapply');

    }

}
