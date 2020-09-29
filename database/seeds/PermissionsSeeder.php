<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createRoleAndPermission('responsavel');
        $this->createRoleAndPermission('atleta');
        $this->createRoleAndPermission('financeiro');
        $this->createRoleAndPermission('treinador');

        $this->createAdminRoleAndUser();
    }

    private function createAdminRoleAndUser()
    {
        $adminRole = Role::create(['name' => 'admin']);

        $adminUser = App\User::create([
            'name'     => env('USER_NAME',     'Admin'),
            'email'    => env('USER_EMAIL',    'admin@admin.com'),
            'password' => Hash::make(env('USER_PASSWORD', 'admin123'))
        ]);

        $adminUser->assignRole($adminRole);
    }

    private function createRoleAndPermission($name)
    {
        $permission = Permission::create(['name' => $name]);
        
        $role = Role::create(['name' => $name]);

        $role->givePermissionTo($permission);
    }
}
