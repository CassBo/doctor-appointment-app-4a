<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'paciente@gmail.com'],
            [
                'name' => 'Paciente',
                'password' => Hash::make('password'),
            ]
        )->assignRole('Paciente');

        User::updateOrCreate(
            ['email' => 'doctor@gmail.com'],
            [
                'name' => 'Doctor',
                'password' => Hash::make('password'),
            ]
        )->assignRole('Doctor');

        User::updateOrCreate(
            ['email' => 'recepcionista@gmail.com'],
            [
                'name' => 'Recepcionista',
                'password' => Hash::make('password'),
            ]
        )->assignRole('Recepcionista');

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        )->assignRole('Administrador');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('Paciente');
        });
    }
}
