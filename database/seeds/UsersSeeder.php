<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        \DB::table('Users')->insertGetId(array(
            'name' => 'Prof. Andrés David Montoya Aguirre',
            'email' => 'admont28@gmail.com',
            'password' => \Hash::make('123456'),
            'rol' => 'profesor',
            'remember_token' => null
        ));
        \DB::table('Users')->insertGetId(array(
            'name' => 'Est. Andrés David Montoya Aguirre',
            'email' => 'admont28@live.com',
            'password' => \Hash::make('123456'),
            'rol' => 'estudiante',
            'remember_token' => null
        ));
        for ($i=0; $i < 20; $i++) {
            \DB::table('Users')->insertGetId(array(
                'name' => $faker->name,
                'email' => $faker->unique()->freeEmail,
                'password' => \Hash::make('123456'),
                'rol' => $faker->randomElement(array ('estudiante', 'profesor')),
                'remember_token' => null
            ));
        }
    }
    
}
