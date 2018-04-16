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
                'from_name' => 'Afro Marketers',
                'from_email' => 'support@afromarketers.com',
                'reply_to' => 'noreply@afromarketers.com',
            ],
        ]);
    }
}
