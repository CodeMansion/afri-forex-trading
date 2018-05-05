<?php

use Illuminate\Database\Seeder;

class GeneralSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::table("general_settings")->truncate();
        \App\GeneralSetting::insert([
            [
                'id'                => 1,
                'application_name'  => 'Markets Profits',
                'system_status_id'  => 1
            ],
        ]);
    }
}
