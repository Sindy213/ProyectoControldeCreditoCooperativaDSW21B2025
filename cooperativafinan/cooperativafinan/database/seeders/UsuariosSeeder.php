<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Modelo de usuario
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que los roles existan antes de asignarlos
        $roles = ['Administrador', 'Cajero', 'Atencion'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Crear usuario Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@cooperativa.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123')
            ]
        );
        $admin->assignRole('Administrador');

        // Crear usuario Cajero
        $cajero = User::firstOrCreate(
            ['email' => 'cajero@cooperativa.com'],
            [
                'name' => 'Cajero',
                'password' => Hash::make('password123')
            ]
        );
        $cajero->assignRole('Cajero');

        // Crear usuario Atención al Cliente
        $atencion = User::firstOrCreate(
            ['email' => 'atencion@cooperativa.com'],
            [
                'name' => 'Atencion',
                'password' => Hash::make('password123')
            ]
        );
        $atencion->assignRole('Atencion');
    }
}
