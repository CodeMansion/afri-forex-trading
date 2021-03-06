<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table("roles")->truncate();
        \DB::table("role_user")->truncate();
        \App\Role::insert([
            'id'        => 1,
            'name'      => 'admin',
            'label'     => 'Administrator',
        ]);

        \App\Role::insert([
            'id'        => 2,
            'name'      => 'super-admin',
            'label'     => 'Super Administrator',
        ]);

        \App\Role::insert([
            'id'        => 3,
            'name'      => 'support',
            'label'     => 'Support Manager',
        ]);

        \App\Role::insert([
            'id'        => 4,
            'name'      => 'testimony',
            'label'     => 'Testimony Manager',
        ]);

        \App\Role::insert([
            'id'        => 5,
            'name'      => 'ds-member',
            'label'     => 'DS Member',
        ]);

        \DB::table("role_user")->insert([
            'id'        => 1,
            'user_id'   => 1,
            'role_id'   => 2
        ]);
    }
}
