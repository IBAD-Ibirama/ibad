<?php

namespace App\Http\Controllers;

use App\Model\Competitions;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $aRegistros = Competitions::all();
        return view('competicoes.index', compact('aRegistros'));
    }

    public function form() {
        return view('competicoes.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Competitions $competition) {
        $competition->date              = $request->data;
        $competition->place             = $request->local;
        $competition->coordinator       = $request->coordenador;
        $competition->competition_level = $request->nivelCompeticao;

        if ($competition->save()) {
            return redirect()
                        ->action('CompetitionController@index')
                        ->with('success', 'Categoria inserida com sucesso!');
        } 

        return redirect()->back()->with('error', 'Falha ao inserir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show($competition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit($competition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $competition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id) {
        $id;
        $competition = Competitions::find($id);
        $competition->delete();
        return 'lka';
    }
}
