<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([ // 1
        	'name' => 'Infraestructura tecnológica',
        	'project_id' => 1
    	]);
    	Level::create([ // 2
        	'name' => 'Desarrollo software',
        	'project_id' => 1
    	]);
		Level::create([ // 2
        	'name' => 'Soporte aplicaciones informáticas',
        	'project_id' => 1
    	]);

    	Level::create([ // 3
        	'name' => 'Infraestructura tecnológica',
        	'project_id' => 2
    	]);
    	Level::create([ // 4
        	'name' => 'Desarrollo software',
        	'project_id' => 2
    	]);
		Level::create([ // 2
        	'name' => 'Soporte aplicaciones informáticas',
        	'project_id' => 2
    	]);
    }
}
