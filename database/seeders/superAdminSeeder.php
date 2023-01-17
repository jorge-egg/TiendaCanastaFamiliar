<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Usuarios;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class superAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrador',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('Gerente');
        $usuario = Usuarios::Create([
            'nombre' => 'Administrador',
            'telefono' => '4562563',
            'direccion' => 'empresa',
            'correo' => 'admin@gmail.com',
            'fotoPerfil' => null
        ]);

    }
}
