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

        $this->call(MovesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SponsorSeeder::class);
        $this->call(AthleteSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TeamAthleteSeeder::class);

        Model::reguard();
    }
}
