<?php

use Illuminate\Database\Seeder;

class MailSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::table("mail_settings")->truncate();
        \App\MailSetting::insert([
            [
                'id' => 1,
                'from_name'     => 'Markets Profits',
                'from_email'    => 'support@profitsmarkets.com',
                'reply_to'      => 'noreply@profitsmarkets.com',
                'host'          => 'mail.marketsprofits.com',
                'username'      => 'admin@marketsprofits.com',
                'password'      => 'Welcome007!@#$',
                'encryption'    => 'TLS',
                'port'          => 587
            ],
        ]);
    }
}
