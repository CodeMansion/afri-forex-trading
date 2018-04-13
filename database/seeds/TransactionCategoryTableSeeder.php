<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\TransactionCategory;
class TransactionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        \DB::table("transaction_categories")->truncate();
        TransactionCategory::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Credit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Debit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ]
        ]);
    }
}
