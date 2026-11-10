<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Administrador', 'email' => 'admin@dataciudad.com', 'role' => 'administrador'],
            ['name' => 'Usuario de Ventanilla', 'email' => 'ventanilla@dataciudad.com', 'role' => 'ventanilla'],
            ['name' => 'Encuestador', 'email' => 'encuestador@dataciudad.com', 'role' => 'encuestador'],
            ['name' => 'Equipo de Calidad', 'email' => 'calidad@dataciudad.com', 'role' => 'calidad'],
            ['name' => 'Usuario Enrutador', 'email' => 'enrutador@dataciudad.com', 'role' => 'enrutador'],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [...$data, 'password' => Hash::make('Dataciudad2026!')]
            );
        }
    }
}
