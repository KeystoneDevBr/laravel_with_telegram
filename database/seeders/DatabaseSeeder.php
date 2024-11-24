<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $administrador = Role::create([
            'name' => Role::ADMINISTRADOR,
            'description' => 'Adminstrador do Painel de Compras',
            'level' => Role::ADMINISTRADOR_LEVEL,
        ]);

        $gerente = Role::create([
            'name' => Role::GERENTE,
            'description' => 'Departamento Financeiro',
            'level' => Role::GERENTE_LEVEL,
        ]);

        $usuario = Role::create([
            'name' => Role::USUARIO,
            'description' => 'Departamento de Compras',
            'level' => Role::USUARIO_LEVEL,
        ]);

        $visualizador = Role::create([
            'name' => Role::VISUALIZADOR,
            'description' => 'Usuário com perfil apenas de visualização',
            'level' => Role::VISUALIZADOR_LEVEL,
        ]);

        User::factory()->create([
            'name' => 'Fagne',
            'email' => 'telegram@gmail.com',
            'password' => bcrypt('telegram'),
            'role_id' => $administrador->id,
        ]);

        User::factory()->create([
            'name' => 'gerente',
            'email' => 'gerente@gmail.com',
            'password' => bcrypt('gerente'),
            'role_id' => $gerente->id,
        ]);

        User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario@gmail.com',
            'password' => bcrypt('usuario'),
            'role_id' => $usuario->id,
        ]);

        User::factory()->create([
            'name' => 'visualizador',
            'email' => 'visualizador@gmail.com',
            'password' => bcrypt('visualizador'),
            'role_id' => $visualizador->id,
        ]);


    }
}
