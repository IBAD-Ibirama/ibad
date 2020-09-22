<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


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
        ],
        [],
        [
            'team_name' => 'Informe o Nome da Turma',
            'teamLevel_name' => 'Informe o Nivel'
        ]);

        $level = $this->handleTeamLevel($request);
        $team =  new Team();
        $team->name = $request['team_name'];

        $team->teamLevel()->associate($level);
        $team->save();

        $path = 'turmas/'. $team->id;
        return Redirect::to($path)->with([
            'success' => "A Turma <b>" . $team->name . "</b> foi criada com sucesso."
        ]);
    }

    private function handleTeamLevel(Request $request){
        $teamLevelId = $request['level_select'];
        $level;
        if($teamLevelId != ''){
            $level = TeamLevel::find($teamLevelId);
        } else {
            $level= new TeamLevel();
            $level->name = $request['teamLevel_name'];

            $level->requires_auxiliary = $request['requires_auxiliary'] == 'on';
            $level->can_be_auxiliary = $request['can_auxiliary'] == 'on';

            $level->save();
        }

        return $level;
    }

    public function show(int $teamID)
    {
        $team = Team::find($teamID);
        $athletes = DB::table('athletes')
            ->select(
                [
                    'users.name as name',
                    'users.id as id',
                    'athletes.id as athlete_id'
                ])
            ->join('users', 'athletes.user_id', '=', 'users.id')
            ->where('athletes.team_id', '=', $team->id)
            ->orderBy('users.name')
            ->get();
        $team->athletes = $athletes;
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
        ], [], [
            'team_name' => 'Informe o Nome da Turma',
            'teamLevel_name' => 'Informe o Nivel'
            ]);

        $team = Team::find($teamID);
        $teamLevelId = $request['level_select'];

        $level = $this->handleTeamLevel($request);

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

        $athletes = $team->athletes;
        if($athletes != null){
            foreach ($athletes as $athlete){
                $athlete->team()->dissociate();
                $athlete->save();
            }
        }

        $teamName = $team->name;
        $team->delete();
        session()->flash('success', "A turma <b>" . $teamName . "</b> foi removida.");
        return Redirect::back();
    }
}
