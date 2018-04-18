<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EarningTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::table("earning_types")->truncate();
        \App\EarningType::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Daily',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Weekly',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 3,
                'slug' => bin2hex(random_bytes(64)),                
                'name' => 'Monthly',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 4,
                'slug' => bin2hex(random_bytes(64)),                
                'name' => 'Quarterly',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ]
        ]);
    }
}
