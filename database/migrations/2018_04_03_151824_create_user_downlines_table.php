<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDownlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_downlines', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('platform_id')->unsigned()->index()->nullable();
            //$table->integer('downline_platform_id')->unsigned()->index()->nullable();
            $table->integer('upline_id')->unsigned()->index();
            $table->integer('downline_id')->unsigned()->index();
            $table->boolean('is_active')->default(false);
            $table->decimal('investment_amount', 10,2)->nullable();
            $table->timestamps();
            
            //$table->foreign('upline_platform_id')->references('id')->on('platforms');
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->foreign('upline_id')->references('id')->on('users');
            $table->foreign('downline_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_downlines');
    }
}
