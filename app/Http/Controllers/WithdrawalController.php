<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Team;
use App\Withdrawal;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WithdrawalController extends Controller
{
    public function index(Team $team)
    {
        $withdrawal = DB::table('withdrawals')
        ->select(
            [
                'users.name as name',
                'withdrawals.id as id',
                'withdrawals.created_at as date'
            ]
        )
            ->where('withdrawals.team_id', '=', $team->id)
            ->join('athletes', 'withdrawals.athlete_id', '=', 'athletes.id')
            ->join('users', 'athletes.user_id', '=', 'users.id')
            ->get();
        $team->withdrawal = $withdrawal;
        return view('withdrawal.show', compact('team'));
    }

    public function create(Team $team)
    {
        $athletes = DB::table('athletes')
            ->select(
                [
                    'users.name as name',
                    'users.id as id',
                    'athletes.id as athlete_id'
                ]
            )
            ->join('users', 'athletes.user_id', '=', 'users.id')
            ->where('athletes.team_id', '=', $team->id)
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->orderBy('users.name')
            ->get();
        $team->athletes = $athletes;

        return view('withdrawal.create', compact('team', 'athletes'));
    }

    public function store(Request $request)
    {
        $athlete_id = $request['athlete'];
        $team_id = $request['team'];

        $athlete = Athlete::find($athlete_id);

        $withdrawal = new Withdrawal();
        $withdrawal->athlete_id = $athlete->id;
        $withdrawal->team_id = $athlete->team->id;
        $withdrawal->save();

        $path = route('withdrawal.index', $athlete->team->id);
        return Redirect::to($path);
    }

    public function destroy(Team $team, Withdrawal $withdrawal)
    {
        $withdrawal->delete();
        $path = route('withdrawal.index', $team->id);
        return Redirect::to($path);
    }
}
