<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PlatformTableSeeder::class);
        $this->call(PackageTypeTableSeeder::class);
        $this->call(PackageTableSeeder::class);
        $this->call(TransactionCategoryTableSeeder::class);
        $this->call(EarningTypeSeeder::class);
    }
}
