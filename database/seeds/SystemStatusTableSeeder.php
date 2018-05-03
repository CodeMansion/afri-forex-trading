<?php

use Illuminate\Database\Seeder;

class SystemStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::table("system_statuses")->truncate();
        \App\SystemStatus::insert([
            [
                'id'    => 1,
                'name'  => 'Active'
            ],
        ]);
        \App\SystemStatus::insert([
            [
                'id'    => 2,
                'name'  => 'Freezed'
            ],
        ]);
        \App\SystemStatus::insert([
            [
                'id'    => 3,
                'name'  => 'Testing'
            ],
        ]);
    }
}
