<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\AthleteEvaluation;
use App\PhysicalTest;
use App\BodyIndex;
use App\Http\Requests\AthleteEvaluationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AthleteEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Athlete $athlete
     * @return \Illuminate\Http\Response
     */
    public function index(Athlete $athlete)
    {
        $evaluations = $athlete->evaluations()->get()->sortByDesc('realization_date');
        return view('athlete_evaluation.index', compact('athlete', 'evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Athlete $athlete
     * @return \Illuminate\Http\Response
     */
    public function create(Athlete $athlete)
    {
        return $this->edit($athlete, new AthleteEvaluation());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AthleteEvaluationForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AthleteEvaluationForm $request)
    {
        return $this->update($request, new AthleteEvaluation());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(AthleteEvaluation $athleteEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Athlete            $athlete
     * @param  \App\AthleteEvaluation  $athleteEvaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Athlete $athlete, AthleteEvaluation $evaluation)
    {
        $physicalTests = PhysicalTest::all()->sortBy('name');
        $bodyIndexes = BodyIndex::all()->sortBy('name');
        return view('athlete_evaluation.edit', compact('athlete', 'evaluation', 'physicalTests', 'bodyIndexes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AthleteEvaluationForm  $request
     * @param  \App\AthleteEvaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(AthleteEvaluationForm $request, AthleteEvaluation $evaluation)
    {
        $request->persist($evaluation);
        return redirect()->route('evaluations.index', ['athlete' => $evaluation->athlete]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AthleteEvaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(AthleteEvaluation $evaluation)
    {
        $athlete = $evaluation->athlete;
        $evaluation->delete();
        return redirect()->route('evaluations.index', compact('athlete'));
    }
}
