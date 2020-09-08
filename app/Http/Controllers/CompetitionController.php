<?php

namespace App\Http\Controllers;

use App\Model\Competitions;
use DateTime;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    const COMPETITION_LEVEL =  [
        1 => 'Alto',
        2 => 'Médio',
        3 => 'Baixo'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $aRegistros = Competitions::all();
        foreach($aRegistros as $registro){
            $registro->date=date('d/m/Y', strtotime($registro->date));
        }
        
        return view('competicoes.index', compact('aRegistros'));
    }

    public function formCadastro() {
        return view('competicoes.cadastrar');
    }

    public function formAlterar(String $id = null) {
        $competicao = null;
        if($id != null) {
            $competicao = Competitions::find($id);
            $competicao->created_at = null;
            $competicao->updated_at = null;
        }
        return view('competicoes.alterar', compact('competicao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Competitions $competition) {
        $request->validate([
            'date' => 'required',
            'descricao' => 'required',
            'competition_level' => 'required',
            'place' => 'required'
        ] );
        $competition->date              = $request->date;
        $competition->place             = $request->place;
        $competition->descricao       = $request->descricao;
        $competition->competition_level = $request->competition_level;

        if ($competition->save()) {
            return redirect()
                        ->action('CompetitionController@index')
                        ->with('success', 'Categoria inserida com sucesso!');
        } 

        return redirect()->back()->with('error', 'Falha ao inserir');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $request->validate([
            'id'=> 'required',
            'date' => 'required',
            'descricao' => 'required',
            'competition_level' => 'required',
            'place' => 'required'
        ] );
        $competition=Competitions::find($request->id);
        $competition->date              = $request->date;
        $competition->place             = $request->place;
        $competition->descricao       = $request->descricao;
        $competition->competition_level = $request->competition_level;
        if(!$competition->save()) {
            dd('Erro ao Alterar');
            
        }
        return redirect()->action('CompetitionController@index');
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
        
        if ($competition->delete()) {
            return redirect()
                        ->action('CompetitionController@index')
                        ->with('success', 'Categoria inserida com sucesso!');
        } 

        return redirect()->back()->with('error', 'Falha ao remover');
    }
}
