<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        $this->runMainSeeders();
        if (App::environment('local')) {
            $this->runTestingSeeders();
        }
        Model::reguard();
    }

    /**
     * Runs the main seeders of the application.<br/>
     * <b>ATTENTION</b> - These seeders will be ran in production enviroment so ensure only necessary data is present.
     */
    public function runMainSeeders() {
        $this->call(PermissionsSeeder::class);
        $this->call(ModalitiesSeeder::class);
        $this->call(CategoriesSeeder::class);
    }

    /**
     * Runs the testing seeders of the application to populate database for testing purposes.
     */
    public function runTestingSeeders() {
        $this->call(MovesSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(AthleteSeeder::class);

        $this->call(TeamSeeder::class);
        $this->call(TeamAthleteSeeder::class);
        $this->call(FaultLimitSeeder::class);
        $this->call(TrainingSeeder::class);

        $this->call(CompetitionsSeeder::class);
        $this->call(PhotosSeeder::class);
        $this->call(CompetitionParticipationSeeder::class);
        $this->call(FinancesSeeder::class);
        
        $this->call(PhysicalTestSeeder::class);
        $this->call(BodyIndexSeeder::class);
    }

}
