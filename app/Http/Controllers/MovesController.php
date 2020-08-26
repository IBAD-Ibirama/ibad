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
            'descricao' => 'required',
            'data' => 'required',
            'valor' => 'required',
            'tipo' => 'required',
            'especificacao' => 'required'
        ]);
        $moves = new Moves([
            'descricao' => $request->descricao,
            'data' => $request->data,
            'valor' => $request->data,
            'tipo' => $request->tipo,
            'especificacao' => $request->especificacao
        ]);
        $moves->save();

        return $this->index()->with([
            'message_success'=> "The move was created successfully" 
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
            'descricao' => 'required',
            'data' => 'required',
            'valor' => 'required',
            'tipo' => 'required',
            'especificacao' => 'required'
        ]);

        $moves -> update([
            'descricao' => $request->descricao,
            'data' => $request->data,
            'valor' => $request->data,
            'tipo' => $request->tipo,
            'especificacao' => $request->especificacao
        ]);

        return $this->index()->with([
            'message_success'=> "The move was updated successfully." 
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
            'message_success'=> "The move was deleted" 
        ]);
    }
}
