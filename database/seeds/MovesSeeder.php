<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MovesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->createUser('John Doe', 'john@doe.com', '123123');
        $this->createMove('Recebimento de patrocinador', '2020-08-27', '100,00', 'entrada', 'Recebimento de verba de empresa', $user->id);
        $this->createMove('Recebimento de mensalidade', '2020-08-27', '50,00', 'entrada', 'Recebimento de mensalidade de aluno', $user->id);
        $this->createMove('Pagamento de novas raquetes', '2020-08-27', '450,00', 'saida', 'Para a empresa Racky S.A', $user->id);
    }

    private function createMove($description, $date, $value, $type, $specification, $user_id)
    {
        DB::table('moves')->insert([
            'description' => $description,
            'date' => $date,
            'value' => $value,
            'type' => $type,
            'specification' => $specification,
            'user_id' => $user_id
        ]);
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
}
