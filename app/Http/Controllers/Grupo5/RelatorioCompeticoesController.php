<?php

namespace App\Http\Controllers\Grupo5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Grupo5\Model\Competicoes;
use \Illuminate\Http\Request;

class RelatorioCompeticoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('grupo5.competicoes.relatorio');
    }
    
    /**
     * Realiza a emissão do relatório
     * 
     * @return Response
     */
    public function emitir(Request $request)
    {
        $aValue = $request->validate([
             'id' => 'required'
            ,'descricao' => 'required'
        ], [], [
             'id' => 'Identificador do Relatório'
            ,'descricao' => 'Descrição do Relatório'
        ]);
        $competicao = Competicoes::find($aValue['id']);
        $descricao  = $aValue['descricao'];
        return view('grupo5.competicoes.emissaorelatorio', [
             'competicao' => $competicao
            ,'descricao'  => $descricao
        ]);
    }
}
