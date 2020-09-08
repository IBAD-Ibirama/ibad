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

        Permission::create(['name' => 'responsavel']);
        Permission::create(['name' => 'atleta']);
        Permission::create(['name' => 'financeiro']);
        Permission::create(['name' => 'treinador']);

        $parentsRole = $this->createRole('responsavel');
        $athleteRole = $this->createRole('atleta');
        $financialRole = $this->createRole('financeiro');
        $coachRole = $this->createRole('treinador');
        $adminRole = Role::create(['name' => 'admin']);

        $user = $this->createUser('Teste', 'teste@teste.com', 'teste123');
        $user->assignRole($adminRole);

        $user = $this->createUser('Admin', 'admin@admin.com', 'admin123');
        $user->assignRole($adminRole);

        $user = $this->createUser('Responsável', 'responsavel@responsavel.com', 'responsavel123');
        $user->assignRole($parentsRole);

        $user = $this->createUser('Atleta', 'atleta@atleta.com', 'atleta123');
        $user->assignRole($athleteRole);

        $user = $this->createUser('Financeiro', 'financeiro@financeiro.com', 'financeiro123');
        $user->assignRole($financialRole);

        $user = $this->createUser('Treinador', 'treinador@treinador.com', 'treinador123');
        $user->assignRole($coachRole);
    }

    private function createUser($name, $email, $password)
    {
        return Factory(App\User::class)->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'remember_token' => null,
        ]);
    }

    private function createRole($name)
    {
        $role = Role::create(['name' => $name]);
        $role->givePermissionTo($name);

        return $role;
    }
}
