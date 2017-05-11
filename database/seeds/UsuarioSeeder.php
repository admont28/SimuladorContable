<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        \DB::table('Usuario')->insertGetId(array(
            'usua_nombre' => 'Prof. Andrés David Montoya Aguirre',
            'usua_correo' => 'admont28@gmail.com',
            'usua_contrasena' => \Hash::make('123456'),
            'usua_rol' => 'profesor',
            'remember_token' => null
        ));
        \DB::table('Usuario')->insertGetId(array(
            'usua_nombre' => 'Est. Andrés David Montoya Aguirre',
            'usua_correo' => 'admont28@live.com',
            'usua_contrasena' => \Hash::make('123456'),
            'usua_rol' => 'estudiante',
            'remember_token' => null
        ));
        for ($i=0; $i < 20; $i++) {
            \DB::table('Usuario')->insertGetId(array(
                'usua_nombre' => $faker->name,
                'usua_correo' => $faker->unique()->freeEmail,
                'usua_contrasena' => \Hash::make('123456'),
                'usua_rol' => $faker->randomElement(array ('estudiante', 'profesor')),
                'remember_token' => null
            ));
        }
    }
}
