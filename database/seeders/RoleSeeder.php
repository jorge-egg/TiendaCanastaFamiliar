<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Gerente']);
        $role2 = Role::create(['name'=>'Supervisor']);
        $role2 = Role::create(['name'=>'Cliente']);

        Permission::create(['name' => 'adm-productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'adm-pedidos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'adm-btn-editCuenta'])->syncRoles([$role1]);
        Permission::create(['name' => 'adm-btn-destroyCuenta'])->syncRoles([$role1]);
        Permission::create(['name' => 'adm-gestionSupervisorCuenta'])->syncRoles([$role1]);
        Permission::create(['name' => 'administrar'])->syncRoles([$role1, $role2]);
    }
}
