<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Support - Project 1
        User::create([ // 3
        	'name' => 'Soporte S1',
        	'email' => 'soporte1@gmail.com',
        	'password' => bcrypt('123456789'),
        	'role' => 1
        ]);
        User::create([ // 4
        	'name' => 'Soporte S2',
        	'email' => 'soporte2@gmail.com',
        	'password' => bcrypt('123456789'),
        	'role' => 1
        ]);
    }
}
