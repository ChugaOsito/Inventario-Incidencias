<?php

namespace Database\Seeders;

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
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);

        $this->call(SupportsTableSeeder::class);
        $this->call(ProjectsUserTableSeeder::class);
        
        $this->call(EstadosTableSeeder::class);
        $this->call(ModelosTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
    }
}
