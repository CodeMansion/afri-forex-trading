<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('slug', 190)->unique();
            $table->string('full_name', 90);
            $table->string('email',100)->unique();
            $table->string('telephone');
            $table->integer('country_id')->unsigned()->index();
            $table->integer('state_id')->nullable();
            $table->timestamps();
            
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('country_id')->references('id')->on('countries');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
