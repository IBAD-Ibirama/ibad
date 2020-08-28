<?php

namespace App\Http\Controllers;

use App\Moves;
use Illuminate\Http\Request;

class MovesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moves = Moves::all();
        return view('moves.index')->with([
            'moves' => $moves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('moves.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
            'value' => 'required',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $moves = Moves::find($id);

        return view('moves.show')->with([
            'moves' => $moves
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $moves = Moves::find($id);

        return view('moves.edit')->with([
            'moves' => $moves
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $moves = Moves::find($id);

        $request->validate([
            'description' => 'required',
            'date' => 'required',
            'value' => 'required',
            'type' => 'required',
            'specification' => 'required'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moves  $moves
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $moves = Moves::find($id);

        $moves->delete();

        return $this->index()->with([
            'message_success' => "A movimentação foi apagada"
        ]);
    }
}
