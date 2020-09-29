<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\CompetitionParticipation;
use App\Model\Competition;
use App\Model\Modality;
use \Illuminate\Support\Facades\DB;

class RegisterAthleteCompetitionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $athletesCompetitions = DB::table('athletes')
            ->select(
                "competition_participation.id",
                "users.name",
                "competitions.date",
                "competitions.place",
                "competitions.description",
                "categories.category",
                "modalities.player_number"
            )
            ->join('competition_participation', 'athletes.id'    , '=', 'competition_participation.athletes_id')
            ->join('competitions'             , 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories'               , 'categories.id'  , '=', 'competition_participation.categories_id')
            ->join('modalities'               , 'modalities.id'  , '=', 'competition_participation.modalities_id')
            ->join('users'                    , 'users.id'       , '=', 'athletes.user_id')
            ->orderBy('competition_participation.created_at', 'desc')
            ->get();

  
        return view('atletas.registerAthleteCompetitition', compact('athletesCompetitions'));
    }

    public function formCadastrar()
    {
        $competitions = Competition::all();
        $categories = Category::all();
        $modalities = Modality::all();
        $athletes = DB::table('users')
        ->join('athletes', 'athletes.user_id', '=', 'users.id')
        ->orderBy('users.name')
        ->get();

        return view('atletas.cadastroRegistroCompeticao', compact('competitions', 'athletes', 'categories', 'modalities'));
    }

    public function formAlterar(String $id = null) {
        $registro = null;
        if($id != null) {
            $registro = DB::table('athletes')
            ->select(
                "competition_participation.id",
                "competition_participation.results",
                "users.name",
                "competitions.id as competition_id",
                "competitions.place",
                "competitions.description",
                "categories.category",
                "modalities.player_number",
                "modalities.id as modality_id",
                "categories.id as category_id"
            )
            ->join('competition_participation', 'athletes.id'    , '=', 'competition_participation.athletes_id')
            ->join('competitions'             , 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories'               , 'categories.id'  , '=', 'competition_participation.categories_id')
            ->join('modalities'               , 'modalities.id'  , '=', 'competition_participation.modalities_id')
            ->join('users'                    , 'users.id'       , '=', 'athletes.user_id')
            ->where('competition_participation.id'  , '=', $id)
            ->first();

            $competitions = Competition::all();
            $categories = Category::all();
            $modalities = Modality::all();
            $athletes = DB::table('users')
            ->join('athletes', 'athletes.user_id', '=', 'users.id')
            ->orderBy('users.name')
            ->first();

        }
        return view('atletas.alterar', compact('registro', 'competitions', 'athletes', 'categories', 'modalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $athletes = $request->athletes;

        foreach ($athletes as $athlete) {
            $participation = new CompetitionParticipation();
            $participation->athletes_id     = $athlete;
            $participation->competitions_id = $request->competition;
            $participation->modalities_id   = $request->modality;
            $participation->categories_id   = $request->category;
            $participation->results         = 'Participante';
            $participation->save();
        }

        return redirect()->action('RegisterAthleteCompetitionController@index')->with('success', 'Participação inserida com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $participation = CompetitionParticipation::find($request->id);
        $participation->competitions_id = $request->competition;
        $participation->modalities_id   = $request->modality;
        $participation->categories_id   = $request->category;
        $participation->results         = $request->result;

        if(!$participation->save()) {
            dd('Erro ao Alterar');
        }

        return redirect()->action('RegisterAthleteCompetitionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function show($idComp, $idAth)
    {

        $competition = DB::table('athletes')
            ->join('competition_participation', 'athletes.id'    , '=', 'competition_participation.athletes_id')
            ->join('competitions'             , 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories'               , 'categories.id'  , '=', 'competition_participation.categories_id')
            ->join('modalities'               , 'modalities.id'  , '=', 'competition_participation.modalities_id')
            ->join('users'                    , 'users.id'       , '=', 'athletes.user_id')
            ->where('competition_participation.competitions_id'  , '=', $idComp)
            ->where('competition_participation.athletes_id'      , '=', $idAth)
            ->get();

            foreach ($competition as $registro) {
                $registro->date = date('d/m/Y', strtotime($registro->date));
                echo $registro->name;
            }
    
            return view('atletas.registerAthleteCompetitition', compact('competition'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id) {
        $competitionParticipation = CompetitionParticipation::find($id);
        
        if ($competitionParticipation->delete()) {
            return redirect()
                        ->action('RegisterAthleteCompetitionController@index')
                        ->with('success', 'Registro removido com sucesso!');
        } 

        return redirect()->back()->with('error', 'Falha ao remover');
    }
}
