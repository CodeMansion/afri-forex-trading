<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::table("users")->truncate();
        \App\User::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(16)),
                'username' => 'MarketsProfits',
                'email' => 'admin@marketsprofits.com',
                'password' => bcrypt('admin1234'),
                'is_admin' => true,
                'is_active' => true,
                'full_name' => "System Administrator",
                'created_at' => '2018-01-01 09:19:28',
                'updated_at' => '2018-01-01 09:19:28',
            ],
        ]);

        \App\User::insert([
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(16)),
                'username' => 'SystemReferral',
                'email' => 'referral@marketsprofits.com',
                'password' => bcrypt('admin1234'),
                'is_admin' => false,
                'is_active' => true,
                'full_name' => "System Referral",
                'created_at' => '2018-01-01 09:19:28',
                'updated_at' => '2018-01-01 09:19:28',
            ],
        ]);

        \App\UserDownline::insert([
            'upline_id' => 1,
            'downline_id'   => 2
        ]);

        \App\UserProfile::insert([
            'user_id' => 2,
            'slug'      => bin2hex(random_bytes(16)),
            'full_name' => "System Referral",
            'email'     => "referral@marketsprofits.com",
            'country_id'    => 566,
            'telephone' => '09010001000'
        ]);

         \App\UserWallet::insert([
            'slug'          => bin2hex(random_bytes(16)),
            'user_id'       => 2,
            'amount'        => 0.00,
            'status'        => 1,
        ]);
    }
}
