<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Athletes;
use \Illuminate\Support\Facades\DB;
use stdClass;

class FrequencyAthlete extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $frequency=new stdClass();
        $frequency->nameAthlete='Rodrigo Santiago';
        $frequency->numberOfLack=2;
        $frequency->numberOfTraining=8;
        $frequency->freqPor=((8-2)/8)*100 . "%";
        
        return view('frequencia.index', compact('frequency'));
    }


}