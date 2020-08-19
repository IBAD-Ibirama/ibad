<?php

use Illuminate\Database\Seeder;
use App\Model\CompetitionParticipation;

class CompetitionParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CompetitionParticipation::class, 10)->create()->each(function ($ret) {
            $ret->save();
        });
    }
}
