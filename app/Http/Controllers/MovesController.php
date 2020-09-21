<?php

namespace App\Http\Controllers;

use App\Moves;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class MovesController extends Controller
{
    public function index()
    {
        // $moves = Moves::whereDate('data', '2020-09-06');
        $moves = Moves::all();
        return view('moves.index')->with([
            'moves' => $moves
        ]);
    }

    public function create()
    {
        return view('moves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
            'value' => 'required|min:0',
            'type' => 'required',
            'specification' => 'required'
        ]);

        $moves = new Moves([
            'description' => $request->description,
            'date' => $request->date,
            'value' => $request->value,
            'type' => $request->type,
            'specification' => $request->specification
        ]);
        $moves->save();

        return $this->index()->with([
            'message_success' => "A movimentação foi cadastrada com sucesso"
        ]);
    }

    public function show($id)
    {
        $moves = Moves::find($id);

        return view('moves.show')->with([
            'moves' => $moves
        ]);
    }

    public function edit($id)
    {
        $moves = Moves::find($id);

        return view('moves.edit')->with([
            'moves' => $moves
        ]);
    }

    public function update(Request $request, $id)
    {
        $moves = Moves::find($id);

        $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'specification' => 'required|string',
        ]);

        $moves->update([
            'description' => $request->description,
            'date' => $request->date,
            'value' => $request->value,
            'type' => $request->type,
            'specification' => $request->specification
        ]);

        return $this->index()->with([
            'message_success' => "A movimentação foi atualizada com sucesso"
        ]);
    }

    public function destroy($id)
    {
        $moves = Moves::find($id);

        $moves->delete();

        session()->flash('success', "Movimentação deletada com sucesso");
        return Redirect::back();
    }
}
