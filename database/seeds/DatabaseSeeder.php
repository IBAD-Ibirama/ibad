<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ModalitiesSeeder::class);
        $this->call(CompetitionsSeeder::class);
        $this->call(AthletesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(PhotosSeeder::class);
        $this->call(CompetitionParticipationSeeder::class);
        $this->call(FinancesSeeder::class);

        Model::reguard();
    }
}
