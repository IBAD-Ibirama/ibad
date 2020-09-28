<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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

        $this->runProductionSeeders();

        if(App::environment('local')) {
            $this->runDevelopmentSeeders();
        }

        Model::reguard();
    }

    private function runProductionSeeders()
    {
        $this->call(PermissionsSeeder::class);
        $this->call(FaultLimitSeeder::class);
        $this->call(PhysicalTestSeeder::class);
        $this->call(BodyIndexSeeder::class);
    }

    private function runDevelopmentSeeders()
    {
        $this->call(MovesSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(AthleteSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TeamAthleteSeeder::class);
    }
}
