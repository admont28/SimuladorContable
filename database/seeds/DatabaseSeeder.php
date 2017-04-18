<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->command->info("UsuarioSeeder -> Ejecutado con éxito =)");
        $this->call(CursoSeeder::class);
        $this->command->info("CursoSeeder -> Ejecutado con éxito =)");
        $this->call(PucComercialSeeder::class);
        $this->command->info("PucComercialSeeder -> Ejecutado con éxito =)");

    }
}
