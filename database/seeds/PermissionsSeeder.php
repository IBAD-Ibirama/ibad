<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Se você criar novas permissões, precisa atualizar o seu banco de dados
 * Para isso, basta rodar:
 *
 * composer dump-autoload
 * php artisan migrate:fresh --seed --seeder=PermissionsSeeder
 *
 * Para mais informações:
 * https://docs.spatie.be/laravel-permission/v3/advanced-usage/seeding/#flush-cache-before-seeding
 *
*/

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::create(['name' => 'admin']);

        $user = Factory(App\User::class)->create([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => Hash::make('teste123'),
            'remember_token' => null,
        ]);
        $user->assignRole($adminRole);

        $user = Factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'remember_token' => null,
        ]);

        $user->assignRole($adminRole);
    }
}
