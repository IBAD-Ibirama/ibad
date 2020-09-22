<?php

namespace App\Http\Controllers;

use App\Athlete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class FrequencyAthlete extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $athlete=Athlete::where('user_id',Auth::user()->id)->first();
        $frequencys = DB::table('frequencies')
            ->join('trainings', 'frequencies.training_id', '=', 'trainings.id')
            ->where('athlete_id', $athlete->id)
            ->get();
            
        return view('frequencia.index', compact('frequencys'));
    }

}