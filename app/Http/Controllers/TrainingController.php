<?php

namespace App\Http\Controllers;

use App\Training;
use App\Team;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $trainings = $team->trainings()->get()->sortBy('date');
        return view('trainings.index', compact('team', 'trainings'));
    }
}
