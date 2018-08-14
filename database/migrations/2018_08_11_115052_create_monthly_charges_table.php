<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 190)->unique();
            $table->integer('user_id')->unsigned();
            $table->decimal('amount_charged',10,2);
            $table->integer('investment_id')->unsigned();
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
        Schema::dropIfExists('monthly_charges');
    }
}
