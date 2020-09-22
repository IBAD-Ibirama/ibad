<?php

namespace App\Http\Controllers;

use App\FaultLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class FaultLimitController extends Controller
{

    public function index()
    {
        $faultLimit = FaultLimit::orderBy('id', 'desc')->first();
        return view('faultlimit.index', compact('faultLimit'));
    }

    public function create()
    {
        $faultLimit = FaultLimit::orderBy('id', 'desc')->first();
        return view('faultlimit.create', compact('faultLimit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'limit' => 'required|min:1',
        ],
        [],
        [
            'limit' => 'Informe o Novo Limite de Faltas',
        ]);

        $newLimit = FaultLimit::create([
            'limit' => $request['limit']
        ]);

        $newLimit->save();

        $path = 'limiteDeFaltas';
        return Redirect::to($path)->with([
            'success' => "O Limite de Faltas foi modificado para <b>" . $newLimit->limit . "</b> com sucesso."
        ]);
    }
}
