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
            ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
            ->join('competitions', 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
            ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->orderBy('competition_participation.created_at', 'desc')
            ->get();

        foreach ($athletesCompetitions as $registro) {
            $registro->date = date('d/m/Y', strtotime($registro->date));
        }
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
            $participation->athletes_id = $athlete;
            $participation->competitions_id = $request->competition;
            $participation->modalities_id = $request->modality;
            $participation->categories_id = $request->category;
            $participation->save();
        }


        return redirect()->action('RegisterAthleteCompetitionController@index')->with('success', 'Participação inserida com sucesso!');
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
            ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
            ->join('competitions', 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
            ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
            ->join('users', 'users.id', '=', 'athletes.user_id')
            ->where('competition_participation.competitions_id', '=', $idComp)
            ->where('competition_participation.athletes_id', '=', $idAth)
            ->get();

            foreach ($competition as $registro) {
                $registro->date = date('d/m/Y', strtotime($registro->date));
                echo $registro->name;
            }
    
            return view('atletas.registerAthleteCompetitition', compact('competition'));
    }
}
