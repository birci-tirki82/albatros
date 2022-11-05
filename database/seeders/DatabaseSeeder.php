<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(WriterSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(RoleSeeder::class);


         User::factory()->create([
             'name' => 'Admin',
             'surname' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => bcrypt('admin'),
         ]);
         User::factory()->create([
             'name' => 'Ömer',
             'surname' => 'Özdemir',
             'email' => 'omer@omer.com',
             'password' => bcrypt('omer'),
         ]);
    }
}
