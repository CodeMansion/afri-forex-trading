<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('mail_settings')){
            $setting = \DB::table("mail_settings")->first();
            if(isset($setting->host)){
                config(['mail.host' => $setting->host]);
                config(['mail.port' => $setting->port]);
                config(['mail.username' => $setting->username]);
                config(['mail.password' => $setting->password]);
                config(['mail.encryption' => $setting->encryption]);
                config(['mail.from.address' => $setting->from_email]);
                config(['mail.from.name' => $setting->from_name]);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
