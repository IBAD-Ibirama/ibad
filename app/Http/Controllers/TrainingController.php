<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(){
        $trainings = Training::orderBy('date', 'asc')->get();
        return view('training.index', compact('trainings'));
    }

    public function show(Training $training){
        return view('training.show', compact('training'));
    }
}
