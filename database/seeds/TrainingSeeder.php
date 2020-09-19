<?php

use App\Local;
use App\Training;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
        factory(Local::class, 5)->create();

        $this->createTraining(6,1,1);
        $this->createTraining(6,1,2);
        $this->createTraining(6,1,1);
        $this->createTraining(6,1,3);
     }

     public function createTraining($trainerID, $teamID, $localID)
     {
         factory(Training::class)->create([
             'trainer_id' => $trainerID,
             'team_id' => $teamID,
             'local_id' => $localID
         ]);
     }
}
