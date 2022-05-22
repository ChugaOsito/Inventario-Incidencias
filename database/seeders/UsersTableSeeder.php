<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //Admin
    User::create([
        'name' => 'Administrador',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('123456789'),
        'role' => 0
    ]);
     //Client
    User::create([
        'name' => 'Cliente 1',
        'email' => 'cliente@gmail.com',
        'password' => bcrypt('123456789'),
        'role' => 2
    ]);
    }
}
