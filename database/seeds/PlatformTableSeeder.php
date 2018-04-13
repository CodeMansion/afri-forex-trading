<?php

use Illuminate\Database\Seeder;
use App\Platform;
use Carbon\Carbon;
class PlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\DB::table("platforms")->truncate();
        \App\Platform::insert([
            [
                'id' => 1,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Daily Signal',
                'is_multiple' => false,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 2,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Investment',
                'is_multiple' => true,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
            [
                'id' => 3,
                'slug' => bin2hex(random_bytes(64)),
                'name' => 'Referrer',
                'is_multiple' => true,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()->addMinute(10),
            ],
        ]);         
    }
}
