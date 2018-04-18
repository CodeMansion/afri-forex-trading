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
                'slug' => bin2hex(random_bytes(64)),
                'username' => 'Afri-Forex',
                'email' => 'admin@codemansion.org',
                'password' => bcrypt('admin1234'),
                'is_admin' => true,
                'is_active' => true,
                'full_name' => "System Admin",
                'created_at' => '2018-01-01 09:19:28',
                'updated_at' => '2018-01-01 09:19:28',
            ],
        ]);
    }
}
