<?php

use Illuminate\Database\Seeder;
use App\Package;
use Carbon\Carbon;
class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::table("packages")->truncate();
        \App\Package::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Starter',
                'investment_amount' => 75,
                'monthly_charge' => 3.5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Bronze',
                'investment_amount' => 150,
                'monthly_charge'    => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 3,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Silver',
                'investment_amount' => 300,
                'monthly_charge'    => 14,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 4,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Gold',
                'investment_amount' => 600,
                'monthly_charge'    => 28,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 5,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Partner',
                'investment_amount' => 1200,
                'monthly_charge'    => 56,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 6,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Leader',
                'investment_amount' => 2400,
                'monthly_charge'    => 112,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 7,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Ambassador',
                'investment_amount' => 5000,
                'monthly_charge'    => 232,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 8,
                'slug' => bin2hex(random_bytes(64)),
                'platform_id' => 2,
                'name' => 'Associate',
                'investment_amount' => 10000,
                'monthly_charge'    => 468,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
        ]);
    }
}
