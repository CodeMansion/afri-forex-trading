<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('slug', 190)->unique();
            $table->integer('transaction_category_id')->unsigned()->index();
            $table->integer('platform_id')->unsigned()->index()->nullable();
            $table->decimal('amount', 10,2);
            $table->boolean('is_paid')->default(false);
            $table->integer('user_id')->unsigned()->index();
            $table->string('reference_no');
            $table->integer('status')->default(0);
            $table->timestamps();

            // $table->foreign('transaction_category_id')->references('id')->on('transaction_categories');
            // $table->foreign('platform_id')->references('id')->on('platforms');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
