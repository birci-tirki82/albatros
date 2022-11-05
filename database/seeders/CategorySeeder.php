<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'parent_id' => 0,
            'name' => 'Kitap Default Kategori',
            'tur' => 'book',
            'slug' => 'kitap',
            'icon' => 'deneme.icon',
            'is_active' => 1,
        ]);
        Category::create([
            'parent_id' => 0,
            'name' => 'Dergi Default Kategori',
            'tur' => 'journal',
            'slug' => 'dergi',
            'icon' => 'deneme.icon',
            'is_active' => 1,
        ]);
    }
}
