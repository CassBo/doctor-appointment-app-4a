<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Llamar al RoleSeeder creado
        $this->call([
            RoleSeeder::class,
        ]);
        //Crea un usuario de prueba cada que ejecuto migrations
        User::factory()->create([ // O puedes usar User::create() si no necesitas los valores por defecto de la factory
            'name' => 'Cassiel Botello',
            'email' => 'cassiel@tecsoftware.com',
            'password' => bcrypt('cassiel'),
        ])->assignRole('Administrador'); // Asigna el rol 'Administrador'

    }
}
