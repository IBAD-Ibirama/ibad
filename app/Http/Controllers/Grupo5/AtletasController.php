<?php

namespace App\Http\Controllers\Grupo5;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

class AtletasController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo5\Model\Atletas  $atletas
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        // $atletas = DB::table('atletas')->where('name', 'John')->first();
        //  = DB::table('atletas')->;

        $participacoesAtleta = DB::table('atletas')
            ->join('participacao_competicao', 'atletas.id', '=', 'participacao_competicao.atleta_id')
            ->join('competicoes', 'competicoes.id', '=', "participacao_competicao.competicao_id")
            ->join('categorias', 'categorias.id', '=', 'participacao_competicao.categoria_id')
            ->join('modalidades', 'modalidades.id', '=', 'participacao_competicao.modalidade_id')
            ->where('atleta_id', $id)
            ->get();

        // dd($participacoesAtleta);
        // die;

        return view('grupo5.atletas.desempenho', compact('participacoesAtleta'));
    }
}
