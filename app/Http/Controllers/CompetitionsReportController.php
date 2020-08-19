<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Model\Competitions;
use \Illuminate\Http\Request;

class CompetitionsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('competicoes.relatorio');
    }
    
    /**
     * Realiza a emissão do relatório
     * 
     * @return Response
     */
    public function emit(Request $request)
    {
        $aValue = $request->validate([
             'id' => 'required'
            ,'descricao' => 'required'
        ], [], [
             'id' => 'Identificador do Relatório'
            ,'descricao' => 'Descrição do Relatório'
        ]);
        $competicao = Competitions::find($aValue['id']);
        $descricao  = $aValue['descricao'];
        return view('competicoes.emissaorelatorio', [
             'competicao' => $competicao
            ,'descricao'  => $descricao
        ]);
    }
}
