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
    public function withdrawal(int $team_id)
    {
        $team = Team::find($team_id);
        $withdrawal = DB::table('withdrawals')
        ->select(
            [
                'users.name as name',
                'withdrawals.id as id',
                'withdrawals.date as date'
            ]
        )
            ->where('withdrawals.team_id', '=', $team->id)
            ->join('athletes', 'withdrawals.athlete_id', '=', 'athletes.id')
            ->join('users', 'athletes.user_id', '=', 'users.id')
            ->get();
        $team->withdrawal = $withdrawal;
        return view('withdrawal.show', compact('team'));
    }

    public function addWithdrawal(Request $request)
    {
        $athlete_id = $request['athlete'];
        $team_id = $request['team'];

        $athlete = Athlete::find($athlete_id);
        $team = Team::find($team_id);

        $withdrawal = Withdrawal::create([
            'date' =>  date_create(),
            'athlete_id' => $athlete_id,
            'team_id' => $team_id


        ]);

        $path = route('team.withdrawal', $team_id);
        return Redirect::to($path);
    }

    public function linksAthletePagewithdrawal(int $team_id)
    {
        $team = Team::find($team_id);

        $athletes = DB::table('athletes')
            ->select(
                [
                    'users.name as name',
                    'users.id as id',
                    'athletes.id as athlete_id'
                ]
            )
            ->join('users', 'athletes.user_id', '=', 'users.id')
            ->where('athletes.team_id', '=', $team_id)
            ->whereNotExists(function($query)
            {
                $query->select(DB::raw(1))
                      ->from('withdrawals')
                      ->whereRaw('withdrawals.athlete_id = athletes.id');
            })
            ->orderBy('users.name')
            ->get();
        $team->athletes = $athletes;

        return view('withdrawal.add-withdrawal', compact('team', 'athletes'));
    }


    public function destroy($team_id, $withdrawal_id)
    {
        $withdrawal = Withdrawal::find($withdrawal_id);
        $withdrawal->delete();
        $path = route('team.withdrawal', $team_id);
        return Redirect::to($path);
    }
}