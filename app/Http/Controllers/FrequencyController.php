<?php

namespace App\Http\Controllers;

use App\Training;
use App\Team;
use App\FaultLimit;
use App\Frequency;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrequencyController extends Controller
{
    public function index(Request $request)
    {
        $faultLimit = FaultLimit::orderBy('id', 'desc')->first();
        $dateStart = $request['dateStart'];
        $dateEnd = $request['dateEnd'];

        $query = DB::table('frequencies')
        ->select([
            'users.name as name',
            'users.id as id',
            'athletes.id as athlete_id',
            DB::raw('COUNT(frequencies.presence) as faltas')
            ])
            ->join('athletes', 'frequencies.athlete_id', '=', 'athletes.id')
        ->join('users', 'athletes.user_id', '=', 'users.id')
        ->join('trainings', 'frequencies.training_id', '=', 'trainings.id')
        ->where('frequencies.presence', '=', false)
        ->orderBy(DB::raw('COUNT(frequencies.presence)'), 'desc')
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                  ->from('withdrawals')
                  ->whereRaw('withdrawals.athlete_id = athletes.id');
        })
        ->groupBy('athletes.id')
        ->groupBy('users.name')
        ->groupBy('users.id');

        if ($dateStart != null) {
            $query->where('trainings.date', '>=', $dateStart);
        }

        if ($dateEnd != null) {
            $query->where('trainings.date', '<=', $dateEnd);
        }

        $faults = $query->get();

        return view('frequency.index', compact('faults', 'faultLimit'));
    }

    public function create(Training $training)
    {
        if (count($training->frequencies()->get()) != 0) {
            return $this->edit($training);
        }
        $team = DB::table('trainings')
            ->join('teams', 'teams.id', '=', 'trainings.team_id')
            ->where('trainings.id', '=', $training->id)
            ->first();

        $athletes = DB::table('trainings')
            ->select([
                'users.name as name',
                'users.id as id',
                'athletes.id as athlete_id'
            ])
            ->join('teams', 'teams.id', '=', 'trainings.team_id')
            ->join('athletes', 'athletes.team_id', '=', 'teams.id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('users.name')
            ->where('trainings.id', '=', $training->id)
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->get();


        $helps = DB::table('trainings')
            ->select([
                'users.name as name',
                'users.id as id',
                'athletes.id as athlete_id'
            ])
            ->join('trainings_helpers', 'trainings.id', '=', 'trainings_helpers.training_id')
            ->join('athletes', 'athletes.id', '=', 'trainings_helpers.helper_id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('users.name')
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->where('trainings_helpers.training_id', '=', $training->id)
            ->get();
        return view('frequency.create', compact('training', 'athletes', 'helps', 'team'));
    }

    public function store(Request $request, Training $training)
    {
        $athletes = $request['athletes'];
        $helps = $request['helps'];

        try {
            foreach ($athletes as $athlete) {
                $this->createFrequency($athlete['athlete_id'], $training->id, $athlete['presence']);
            }
            if ($helps != null) {
                foreach ($helps as $help) {
                    $this->createFrequency($help['athlete_id'], $training->id, $help['presence']);
                }
            }
        } catch (\Throwable $th) {
            session()->flash('warning', "Não foi possível cadastrar a chamada");
            return ['code' => 500 ];
        }

        session()->flash('success', "Chamada cadastrada com sucesso");
        return ['code' => 200];
    }

    private function createFrequency($athlete_id, $training_id, $presence)
    {
        $frequency = new Frequency();
        $frequency->athlete_id = $athlete_id;
        $frequency->training_id = $training_id;
        $frequency->presence = $presence;
        $frequency->save();
    }

    public function edit(Training $training)
    {
        if (count($training->frequencies()->get()) == 0) {
            $path = route('training.show', $training->id);
            return Redirect::to($path)->with([
                'message_success' => "Treino do dia <b>" . $training->date . "</b> não possui chamada feita."
            ]);
        }

        $athletes = DB::table('trainings')
            ->select([
                'users.name as name',
                'users.id as id',
                'athletes.id as athlete_id',
                'frequencies.presence as presence',
                'frequencies.id as frequency_id'
            ])
            ->join('frequencies', 'frequencies.training_id',  '=', 'trainings.id')
            ->join('athletes', 'athletes.id', '=', 'frequencies.athlete_id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('users.name')
            ->where('trainings.id', '=', $training->id)
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->get();

        $helps = DB::table('trainings')
            ->select([
                'users.name as name',
                'users.id as id',
                'athletes.id as athlete_id',
                'frequencies.presence as presence',
                'frequencies.id as frequency_id'
            ])
            ->join('trainings_helpers', 'trainings_helpers.training_id',  '=', 'trainings.id')
            ->join('athletes', 'athletes.id', '=', 'trainings_helpers.helper_id')
            ->join('frequencies', 'frequencies.athlete_id',  '=', 'athletes.id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('users.name')
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->where('trainings.id', '=', $training->id)
            ->get();

        return view('frequency.edit', compact('training', 'athletes', 'helps'));
    }

    public function update(Request $request, Training $training)
    {
        $athletes = $request['athletes'];
        $helps = $request['helps'];

        try {
            foreach ($athletes as $athlete) {
                $this->editFrequency($athlete['frequency_id'], $athlete['presence']);
            }
            if ($helps != null) {
                foreach ($helps as $help) {
                    $this->editFrequency($help['frequency_id'], $help['presence']);
                }
            }
        } catch (\Throwable $th) {
            session()->flash('warning', "Não foi possível editar a chamada");
            return ['code' => 500 ];
        }

        session()->flash('success', "Chamada editada com sucesso");
        return ['code' => 200];
    }

    private function editFrequency($frequency_id, $presence)
    {
        $frequency = Frequency::find($frequency_id);
        $frequency->presence = $presence;
        $frequency->save();
    }

}
