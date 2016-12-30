<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavetypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        //
        Schema::create('leavetype', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('lid')->unique();
            // $table->string('name')->nullable();

            $table->string('name')->nullable();
            $table->string('islimit')->nullable();

            $table->string('limit')->nullable();
            //$table->string('leave_type');


           // $table->rememberToken();
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
        Schema::drop('leavetype');

    }

}
