<?php

namespace Database\Seeders;

use App\Models\Writer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Writer::create([
            'name' => 'Ömer Faruk',
            'lastname' => 'Özdemir',
            'info' => 'Deneme İnfo',
            'image' => 'deneme.jpg',
        ]);
    }
}
