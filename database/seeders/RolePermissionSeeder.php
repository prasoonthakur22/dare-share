<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $viewPermission = Permission::create(['name' => 'view']);
        $editPermission = Permission::create(['name' => 'edit']);

        $adminRole->givePermissionTo($viewPermission, $editPermission);
        $userRole->givePermissionTo($viewPermission);
    }
}
