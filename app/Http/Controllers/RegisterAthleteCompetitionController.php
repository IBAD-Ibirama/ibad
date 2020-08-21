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
    public function index()
    {
        $athletes = Athletes::all();

        $competitions = Competitions::all();

        $categories = Categories::all();

        $modalities = Modalities::all();

        $athletesCompetitions = DB::table('athletes')
            ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
            ->join('competitions', 'competitions.id', '=', 'competition_participation.competitions_id')
            ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
            ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
            ->orderBy('competition_participation.created_at', 'desc')
            ->get();

        return view('atletas.registerAthleteCompetitition', compact('athletes', 'competitions', 'athletesCompetitions', 'categories', 'modalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompetitionParticipation $participation)
    {
        $participation->athletes_id     = $request->athleteId;
        $participation->competitions_id = $request->competitionId;
        $participation->modalities_id   = $request->modalitiesSelect;
        $participation->modalities_id   = $request->CategorySelect;
        $participation->categories_id   = $request->modalitiesSelect;
        
        $participation->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
