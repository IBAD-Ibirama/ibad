<?php

namespace App\Http\Controllers;

use App\Model\Competition;
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
        $competitions = Competition::all();
        foreach($competitions as $competition){
            $competition->date=date('d/m/Y', strtotime($competition->date));
        }
        
        return view('competicoes.index', compact('competitions'));
    }

    public function formCadastro() {
        return view('competicoes.cadastrar');
    }

    public function formAlterar(String $id = null) {
        $competicao = null;
        if($id != null) {
            $competicao = Competition::find($id);
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
    public function create(Request $request, Competition $competition) {
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
                        ->with('success', 'Competição inserida com sucesso!');
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
            'id' => 'required',
            'date' => 'required',
            'descricao' => 'required',
            'competition_level' => 'required',
            'place' => 'required'
        ]);
        
        $competition = Competition::find($request->id);
        $competition->update([
             'date' => $request->date
            ,'place' => $request->place
            ,'descricao' => $request->description
            ,'competition_level' => $request->competition_level
        ]);
        return $this->index()->with([
            'message_success' => "O atleta foi atualizado com sucesso"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id) {
        $competition = Competition::find($id);
        
        if ($competition->delete()) {
            return redirect()
                        ->action('CompetitionController@index')
                        ->with('success', 'Competição inserida com sucesso!');
        } 

        return redirect()->back()->with('error', 'Falha ao remover');
    }
}
