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
                'from_name'     => 'Profits Markets',
                'from_email'    => 'support@profitsmarkets.com',
                'reply_to'      => 'noreply@profitsmarkets.com',
                'host'          => 'smtp.gmail.com',
                'username'      => 'brainajax@gmail.com',
                'password'      => 'PhilliPiansPhilliPians$413',
                'encryption'    => 'TLS',
                'port'          => 587
            ],
        ]);
    }
}
