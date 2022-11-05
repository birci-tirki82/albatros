<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

//        Role::create([
//            'name' => 'editor',
//            'slug' => 'editor',
//            'description' => 'System Editor',
//            'is_main' => 1,
//            'is_see_admin' => 1,
//            'guard_name' => 'web',
//        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
    }
}
