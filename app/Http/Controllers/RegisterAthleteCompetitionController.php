<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Athletes;
use App\Model\Categories;
use App\Model\CompetitionParticipation;
use App\Model\Competitions;
use App\Model\Modalities;
use \Illuminate\Support\Facades\DB;

class RegisterAthleteCompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $athletesCompetitions = DB::table('athletes')
            ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
            ->join('competitions', 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
            ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
            ->orderBy('competition_participation.created_at', 'desc')
            ->get();

        foreach($athletesCompetitions as $registro){
                $registro->date=date('d/m/Y', strtotime($registro->date));
        }
        return view('atletas.registerAthleteCompetitition', compact('athletesCompetitions'));
    }

    public function formCadastrar() {
        $competitions = Competitions::all();
        $athletes     = Athletes::all();
        $categories   = Categories::all();
        $modalities   = Modalities::all();
        return view('atletas.cadastroRegistroCompeticao', compact('competitions', 'athletes', 'categories', 'modalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompetitionParticipation $participation)
    {
        $participation->athletes_id     = $request->athlete;
        $participation->competitions_id = $request->competition;
        $participation->modalities_id   = $request->modality;
        $participation->categories_id   = $request->category;
        
        $participation->save();
        return redirect()->action('registerAthleteCompetitionController@index')->with('success', 'Categoria inserida com sucesso!');
    }

}
