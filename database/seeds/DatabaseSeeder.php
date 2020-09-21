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

        Model::reguard();
    }
}
