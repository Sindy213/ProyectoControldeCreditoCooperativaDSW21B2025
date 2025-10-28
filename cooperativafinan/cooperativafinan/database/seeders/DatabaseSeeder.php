<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Crear roles y permisos primero
        $this->call(RolesSeeder::class);

        // 2️⃣ Crear usuarios que dependen de los roles
        $this->call(UsuariosSeeder::class);

        // 3️⃣ Opcional: puedes agregar seeders para clientes, créditos, etc.
        // $this->call(ClientesSeeder::class);
        // $this->call(TiposCreditoSeeder::class);
    }
}
