<?php

use Illuminate\Database\Seeder;
use App\TeamLevel;
use App\Team;
use \Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $basicLevel = TeamLevel::create([
        'name' => 'Basico',
        'requires_auxiliary' => true,
        'can_be_auxiliary' => false
      ]);

      $basicLevel->save();

      $middleLevel = TeamLevel::create([
        'name' => 'Médio',
        'requires_auxiliary' => false,
        'can_be_auxiliary' => false
        ]);
      $middleLevel->save();

      $advancedLevel = TeamLevel::create([
          'name' => 'Avançado',
          'requires_auxiliary' => false,
          'can_be_auxiliary' => true
          ]);
      $advancedLevel->save();

      $team1 = Team::create([
        'name' => 'Ibad',
        'team_level_id' => $basicLevel->id
      ]);
      $team1->save();

      $team2 = Team::create([
        'name' => 'Ibad - Médios',
        'team_level_id' => $middleLevel->id
      ]);

      $team2->save();
    }
}
