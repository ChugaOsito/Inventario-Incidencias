<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Hardware',
            'project_id' => 1
        ]);
        Category::create([
            'name' => 'Software',
            'project_id' => 1
        ]);
        Category::create([
            'name' => 'Hardware',
            'project_id' => 2
        ]);
        Category::create([
            'name' => 'Software',
            'project_id' => 2
        ]);
    }

}
