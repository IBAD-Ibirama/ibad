<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Team;
use App\TeamLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatriculateController extends Controller
{

  public function create(Team $team)
  {
    $teamLevels = TeamLevel::all();
    $athletes = Athlete::all();
    $teams = Team::all();
    return view('matriculate.create', compact('team', 'athletes', 'teams', 'teamLevels'));
  }

  public function store(Request $request, Team $team)
  {
    $athlete = Athlete::find($request['athlete_id']);
    $athlete->team()->associate($team);
    $athlete->save();


    $path = 'turmas/'. $team->id;
    return Redirect::to($path);
  }

  public function destroy(Team $team, Athlete $athlete)
  {
    $athlete->team()->dissociate();
    $athlete->save();

    $path = 'turmas/'. $team->id;
    return Redirect::to($path);
  }
}
