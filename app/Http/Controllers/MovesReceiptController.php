<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moves;
use PDF;

class MovesReceiptController extends Controller
{
    public function create(Request $request, $id)
    {
        $move = Moves::find($id);

        $pdf = PDF::loadView('receipt', compact('move'));

        return $pdf->setPaper('a4', 'landscape')->stream('recibo.pdf');
    }
}
