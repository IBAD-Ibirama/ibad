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

        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'view']);

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

        $parentsRole = Role::create(['name' => 'pais']);
        $parentsRole->givePermissionTo('edit');
        $parentsRole->givePermissionTo('delete');
        $parentsRole->givePermissionTo('create');
        $parentsRole->givePermissionTo('view');

        $athleteRole = Role::create(['name' => 'atleta']);
        $athleteRole->givePermissionTo('edit');
        $athleteRole->givePermissionTo('delete');
        $athleteRole->givePermissionTo('create');
        $athleteRole->givePermissionTo('view');

        $financialRole = Role::create(['name' => 'financeiro']);
        $financialRole->givePermissionTo('edit');
        $financialRole->givePermissionTo('delete');
        $financialRole->givePermissionTo('create');
        $financialRole->givePermissionTo('view');

        $coachRole = Role::create(['name' => 'treinador']);
        $coachRole->givePermissionTo('edit');
        $coachRole->givePermissionTo('delete');
        $coachRole->givePermissionTo('create');
        $coachRole->givePermissionTo('view');

        $user = Factory(App\User::class)->create([
            'name' => 'Pais',
            'email' => 'pais@pais.com',
            'password' => Hash::make('pais123'),
            'remember_token' => null,
        ]);
        $user->assignRole($parentsRole);

        $user = Factory(App\User::class)->create([
            'name' => 'Atleta',
            'email' => 'atleta@atleta.com',
            'password' => Hash::make('atleta123'),
            'remember_token' => null,
        ]);
        $user->assignRole($athleteRole);

        $user = Factory(App\User::class)->create([
            'name' => 'Financeiro',
            'email' => 'financeiro@financeiro.com',
            'password' => Hash::make('financeiro123'),
            'remember_token' => null,
        ]);
        $user->assignRole($financialRole);

        $user = Factory(App\User::class)->create([
            'name' => 'Treinador',
            'email' => 'treinador@treinador.com',
            'password' => Hash::make('treinador123'),
            'remember_token' => null,
        ]);
        $user->assignRole($coachRole);
    }
}
