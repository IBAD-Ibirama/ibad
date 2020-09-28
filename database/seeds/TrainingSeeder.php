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

        $this->createTraining(6,1,1,new DateTime('2020-11-02'), "19:00", "20:00", "Segunda-Feira");
        $this->createTraining(6,1,2,new DateTime('2020-11-03'), "19:30", "20:30", "Terça-Feira");
        $this->createTraining(6,1,1,new DateTime('2020-11-04'), "20:00", "21:00", "Quarta-Feira");
        $this->createTraining(6,1,3,new DateTime('2020-11-05'), "19:00", "20:00", "Quinta-Feira");
     }

     public function createTraining($trainerID, $teamID, $localID, $date, $timeInit, $timeEnd,$weekDay)
     {
         factory(Training::class)->create([
             'trainer_id' => $trainerID,
             'team_id' => $teamID,
             'local_id' => $localID,
             'date' => $date,
             'time_init' => $timeInit,
             'time_end' => $timeEnd,
             'week_day' => $weekDay
         ]);
     }
}
