<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moves;
use PDF;

class MovesReportController extends Controller
{
    public function create()
    {
        $moves = Moves::all();
        $pdf = PDF::loadView('pdf', compact('moves'));

        return $pdf->setPaper('a4')->stream('movimentações.pdf');
    }
}
