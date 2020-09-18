
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSponsor('96.499.807/0001-90', 'Omil', 'contato@omil.com.br');
        $this->createSponsor('62.139.751/0001-40', 'UDESC', 'contato@udesc.br');
        $this->createSponsor('22.487.789/0001-90', 'UFSC', 'contato@ufsc.br');
    }

    private function createSponsor($cnpj, $name, $email)
    {
        DB::table('sponsors')->insert([
            'cnpj' => $cnpj,
            'name' => $name,
            'email' => $email,
        ]);
    }
}
