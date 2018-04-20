<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('application_name');
            $table->string('motto')->nullable();
            $table->string('description')->nullable();
            $table->string('logo_file_name')->nullable();
            $table->boolean('enable_sound_notification')->default(true);
            $table->boolean('enable_push_notification')->default(true);
            $table->boolean('enable_session_timeout')->default(false);
            $table->boolean('enable_login_email_alert')->default(false);
            $table->string('currency_exchange_api')->nullable();
            $table->string('default_currency')->nullable();
            $table->boolean('enable_system_backup')->default(true);
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
        Schema::dropIfExists('general_settings');
    }
}
