<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->engine = 'InnoDB';            
            $table->increments('id');
            $table->string('slug', 190)->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('platform_id')->unsigned()->index();
            $table->integer('earning_type_id')->unsigned()->index()->nullable();
            $table->decimal('amount', 10,2);
            $table->boolean('status')->default(0);
            $table->timestamps();
            
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('platform_id')->references('id')->on('platforms');
            // $table->foreign('earning_type_id')->references('id')->on('earning_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('earnings');
    }
}
