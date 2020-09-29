<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

class AthletesCompetitionController extends Controller
{
    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $participacoesAtleta = DB::table('athletes')
            ->join('competition_participation', 'athletes.id'    , '=', 'competition_participation.athletes_id')
            ->join('competitions'             , 'competitions.id', '=', "competition_participation.competitions_id")
            ->join('categories'               , 'categories.id'  , '=', 'competition_participation.categories_id')
            ->join('modalities'               , 'modalities.id'  , '=', 'competition_participation.modalities_id')
            ->where('athletes_id', $id)
            ->get();
        
        return view('atletas.desempenho', compact('participacoesAtleta'));
    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $participacoesAtleta = DB::table('athletes')
            ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
            ->join('competitions', 'competitions.id', '=', "competition_participation.competitions_id")
            ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
            ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
            ->get();
            
        return view('atletas.desempenho', compact('participacoesAtleta'));
    }
}
