<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputeRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_replies', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('slug', 190)->unique();
            $table->integer('dispute_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->text('message');
            $table->timestamps();

            // $table->foreign('dispute_id')->references('id')->on('disputes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispute_replies');
    }
}
