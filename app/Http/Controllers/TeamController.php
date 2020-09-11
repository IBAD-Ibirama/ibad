<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('name', 'asc')->get();
        return view('team.index', compact('teams'));
    }

    public function create()
    {
      $teamLevels = TeamLevel::all();
      return view('team.create', compact('teamLevels'));
    }

    public function store(Request $request)
    {
      $request->validate([
        'team_name' => 'required|min:3',
        'teamLevel_name' => 'required|min:3'
      ]);

      $teamLevel_id = $request['level_select'];
      $level;
      if($teamLevel_id != ''){
        $level = TeamLevel::find($teamLevel_id);
      } else {
        $level= new TeamLevel();
        $level->name = $request['teamLevel_name'];
        $level->requires_auxiliary = $request['requires_auxiliary'] == 'on' ? true : false;
        $level->can_be_auxiliary = $request['can_be_auxiliary'] == 'on' ? true : false;

        $level->save();
      }

      $team =  new Team();
      $team->name = $request['team_name'];

      $team->teamLevel()->associate($level);
      $team->save();

      $path = 'turmas/'. $team->id;
      return Redirect::to($path)->with([
        'message_success' => "A Turma <b>" . $team->name . "</b> foi criada com sucesso."
      ]);
    }

    public function show(int $teamID)
    {
      $team = Team::find($teamID);
      return view('team.show', compact('team'));
    }

    public function edit(int $teamID)
    {
      $team = Team::find($teamID);
      $teamLevels = TeamLevel::all()->where('id', '!=', $team->teamLevel->id);
      $allTeamLevels = TeamLevel::all();
      return view('team.edit', compact('team','teamLevels', 'allTeamLevels'));
    }

    public function update(Request $request, int $teamID)
    {
      $request->validate([
        'team_name' => 'required|min:3',
        'teamLevel_name' => 'required|min:3'
      ]);

      $team = Team::find($teamID);
      $teamLevel_id = $request['level_select'];

      $level;
      if($teamLevel_id != ''){
        $level = TeamLevel::find($teamLevel_id);
      } else {
        $level= new TeamLevel();
        $level->name = $request['teamLevel_name'];
        $level->requires_auxiliary = $request['requires_auxiliary'] == 'on' ? true : false;
        $level->can_be_auxiliary = $request['can_be_auxiliary'] == 'on' ? true : false;

        $level->save();
      }

      $team->name = $request['team_name'];

      $team->teamLevel()->associate($level);
      $team->save();

      $path = 'turmas/'. $team->id;
      return Redirect::to($path)->with([
        'message_success' => "Os dados da Turma <b>" . $team->name . "</b> foram atualizados."
      ]);
    }

    public function destroy(int $teamID)
    {
      $team = Team::find($teamID);
      $teamName = $team->name;
      $team->delete();
      session()->flash('success', "A turma <b>" . $teamName . "</b> foi removida.");
      return Redirect::back();
    }
}
