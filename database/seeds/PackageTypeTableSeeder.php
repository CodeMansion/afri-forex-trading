<?php

use Illuminate\Database\Seeder;
use App\PackageType;
use Carbon\Carbon;
class PackageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::table("package_types")->truncate();
        \App\PackageType::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Daily',
                'percentage' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Weekly',
                'percentage' => 350,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 3,
                'slug' => bin2hex(random_bytes(64)),                
                'name' => 'Monthly',
                'percentage' => 400,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 4,
                'slug' => bin2hex(random_bytes(64)),                
                'name' => 'Quarterly',
                'percentage' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ]
        ]);
    }
}
