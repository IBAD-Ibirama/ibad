<?php

namespace App\Http\Controllers;

use App\Athlete;
use Illuminate\Http\Request;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = Athlete::all()->sortBy('name');
        return view('athletes.index', compact('athletes'));
    }
}
