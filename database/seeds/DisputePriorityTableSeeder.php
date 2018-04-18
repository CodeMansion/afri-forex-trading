<?php

use Illuminate\Database\Seeder;

class DisputePriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::table("dispute_priorities")->truncate();
        \App\DisputePriority::insert([
            [
                'id' => 1,
                'name' => 'High',
            ],
        ]);
        \App\DisputePriority::insert([
            [
                'id' => 2,
                'name' => 'Medium',
            ],
        ]);
        \App\DisputePriority::insert([
            [
                'id' => 3,
                'name' => 'Low',
            ],
        ]);
    }
}
