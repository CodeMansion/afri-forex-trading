<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
	
	/**
	* Run the migrations.
	     *
	     * @return void
	     */
	    public function up()
	    {
		Schema::create('referrals', function (Blueprint $table) {
			$table->engine = "InnoDB";
			$table->increments('id');
			$table->string('slug', 190)->unique();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('platform_id')->unsigned()->index();
			$table->integer('status')->default(0);
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('platform_id')->references('id')->on('platforms');
		}
		);
	}
	
	
	/**
	* Reverse the migrations.
	     *
	     * @return void
	     */
	    public function down()
	    {
		Schema::dropIfExists('referrals');
	}
}
