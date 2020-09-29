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
        $athlete = Athlete::where('user_id', Auth::user()->id)->first();
        
        return view('queryathlete.show', compact('athlete'));
    }
}