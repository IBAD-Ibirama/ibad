<?php

namespace App\Http\Controllers;

use App\Training;
use App\Team;
use App\Frequency;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrequencyController extends Controller
{

    public function create(Training $training)
    {

        if($training->frequencies() == null{

        }
        $team = DB::table('trainings')
        ->join('teams', 'teams.id', '=', 'trainings.team_id')
        ->where('trainings.id', '=', $training->id)
        ->first();

        $athletes = DB::table('trainings')
        ->select(
            [
                'users.name as name',
                'users.id as id',
                'athletes.id as athlete_id'
                ]
                )
                ->join('teams', 'teams.id', '=', 'trainings.team_id')
                ->join('athletes', 'athletes.team_id', '=', 'teams.id')
                ->join('users', 'users.id', '=', 'athletes.user_id')
                ->orderBy('users.name')
                ->where('trainings.id', '=', $training->id)
                ->get();


                $helps = DB::table('trainings')
                ->select(
                    [
                        'users.name as name',
                        'users.id as id',
                        'athletes.id as athlete_id'
                        ]
                        )
            ->join('trainings_helpers', 'trainings.id', '=', 'trainings_helpers.training_id')
            ->join('athletes', 'athletes.id', '=', 'trainings_helpers.helper_id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('users.name')
            ->where('trainings_helpers.training_id', '=', $training->id)
            ->get();
        return view('frequency.create', compact('training', 'athletes', 'helps', 'team'));
    }

    public function store(Request $request, Training $training) {
        $athletes = $request['athletes'];

        try {
            foreach ($athletes as $athlete){
                $frequency = new Frequency();
                $frequency->athlete_id = $athlete['athlete_id'];
                $frequency->training_id = $training->id;
                $frequency->presence = $athlete['presence'];
                $frequency->save();

            }
        } catch (\Throwable $th) {
            session()->flash('error', "Não foi possivel cadastrar a chamada");
            return ['code' => 500 ];
        }

        session()->flash('success', "Chamada cadastrada com sucesso");
        return ['code' => 200 ];
    }
}
