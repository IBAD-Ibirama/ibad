<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;
use App\Moves;
use PDF;

class MovesReceiptController extends Controller
{
    public function create(Request $request, $id)
    {
        $move = Moves::find($id);
        $extensiveNumberConverter = new NumeroPorExtenso;
        $extensiveNumber = $extensiveNumberConverter->converter((int) $move->value);

        $pdf = PDF::loadView('receipt', compact('move', 'extensiveNumber'));

        return $pdf->setPaper('a4', 'landscape')->stream('recibo.pdf');
    }
}
