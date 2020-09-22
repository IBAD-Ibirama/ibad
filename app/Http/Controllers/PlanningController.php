<?php

namespace App\Http\Controllers;

use App\Planning;
use App\Training;
use App\Team;
use App\Http\Requests\PlanningForm;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Team      $team
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team, Training $training)
    {
        $plannings = $training->plannings()->get()->sortBy('date');
        return view('plannings.index', compact('team', 'training', 'plannings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Team      $team
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team, Training $training)
    {
        return $this->edit($team, $training, new Planning());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PlanningForm  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanningForm $request)
    {
        return $this->update($request, new Planning());
    }

    /**
     * Show the form for showing the specified resource.
     *
     * @param  \App\Team      $team
     * @param  \App\Training  $training
     * @param  \App\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, Training $training, Planning $planning)
    {
        return view('plannings.show', compact('team', 'training', 'planning'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team      $team
     * @param  \App\Training  $training
     * @param  \App\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Training $training, Planning $planning)
    {
        return view('plannings.edit', compact('team', 'training', 'planning'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PlanningForm  $request
     * @param  \App\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function update(PlanningForm $request, Planning $planning)
    {
        $request->persist($planning);
        return redirect()->route('plannings.index', ['team' => $planning->training->team, 'training' => $planning->training]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Planning  $planning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planning $planning)
    {
        $team = $planning->training->team;
        $training = $planning->training;
        $planning->delete();
        return redirect()->route('plannings.index', compact('team', 'training'));
    }
}
