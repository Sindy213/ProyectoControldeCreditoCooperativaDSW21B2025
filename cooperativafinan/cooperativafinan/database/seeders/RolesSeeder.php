<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Lista de permisos
        $perms = [
            'clientes.create','clientes.view','clientes.edit','clientes.delete',
            'creditos.create','creditos.view','creditos.edit','creditos.close',
            'pagos.create','pagos.view','pagos.delete',
            'solicitudes.create','solicitudes.review','solicitudes.approve','solicitudes.reject',
            'citas.manage',
            'dashboard.view','reports.view',
            'users.manage','roles.manage','permissions.manage'
        ];

        // Crear permisos
        foreach ($perms as $p) {
            Permission::firstOrCreate([
                'name' => $p,
                'guard_name' => 'web'
            ]);
        }

        // Crear roles y asignar permisos
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $admin->givePermissionTo(Permission::all());

        $cajero = Role::firstOrCreate(['name' => 'Cajero', 'guard_name' => 'web']);
        $cajero->givePermissionTo([
            'pagos.create','pagos.view','creditos.view','clientes.view'
        ]);

        $atencion = Role::firstOrCreate(['name' => 'Atencion', 'guard_name' => 'web']);
        $atencion->givePermissionTo([
            'clientes.create','clientes.view','solicitudes.review','citas.manage'
        ]);
    }
}
