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
        $request->validate([
            'athlete_id' => 'required',
        ],
        [],
        [
            'athlete_id' => "Informe o atleta que deseja adicionar a turma ". $team->name,
        ]);

        $athlete = Athlete::find($request['athlete_id']);
        if($athlete->team != null && $athlete->team->id == $team->id){
            $path = 'turmas/'. $team->id;
            return Redirect::to($path)->with([
                "success" => "A Turma <b>" . $athlete->user->name . "</b> ja está matriculado(a) na turma <b>" . $team->name . "</b>"
            ]);
        }
        $athlete->team()->associate($team);
        $athlete->save();


        $path = 'turmas/'. $team->id;
        return Redirect::to($path)->with([
            'success' => "O atleta <b>" . $athlete->user->name . "</b> foi matriculado(a) com sucesso."
        ]);
    }

    public function destroy(Team $team, Athlete $athlete)
    {
        $athlete->team()->dissociate();
        $athlete->save();

        $path = 'turmas/'. $team->id;
        return Redirect::to($path)->with([
            'success' => "O atleta <b>" . $athlete->user->name . "</b> foi removido(a) da turma <b>" . $team->name . "</b> com sucesso."
        ]);
    }
}
