<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        //
        Schema::create('pref', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('pid');
            // $table->string('name')->nullable();

            $table->string('ylimit')->nullable();
            $table->string('ontime')->nullable();
          //  $table->string('leave_type');


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
        Schema::drop('pref');

    }


}
