<?php

namespace App\Http\Controllers;

use App\Athlete;
use Illuminate\Support\Facades\Auth;

class QueryAthelteController extends Controller {
    /**
     * Display the specified resource.
     *
     * @param  \App\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function show() {

        $athlete = Athlete::find(Auth::user()->id);
        
        return view('queryathlete.show', compact('athlete'));
    }
}