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

        $this->call(MovesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(AthleteSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TeamAthleteSeeder::class);
        $this->call(FaultLimitSeeder::class);
        $this->call(TrainingSeeder::class);
        $this->call(PhysicalTestSeeder::class);
        $this->call(BodyIndexSeeder::class);

        Model::reguard();
    }
}
