<?php

namespace App\Http\Controllers;

use App\Moves;
use Illuminate\Http\Request;
use PDF;

class MovesReportController extends Controller
{
    public function create(Request $request)
    {
        $date = $request->query('data');
        $totalDeposit = 0;
        $totalOutflows = 0;

        if ($date) {
            list($year, $month) = explode('-', $date);
            $moves = Moves::whereYear('date', '=', $year)
                ->whereMonth('date', '=', $month)
                ->get();
        } else {
            $moves = Moves::all();
        }
        foreach ($moves as &$move) {
            if ($move->type == 'entrada') {
                $totalDeposit += floatval($move->value);
            } else {
                $totalOutflows += floatval($move->value);
            }
        }

        $pdf = PDF::loadView('pdf', compact('moves', 'totalDeposit', 'totalOutflows'));

        return $pdf->setPaper('a4')->stream('movimentações.pdf');
    }
}
