<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Model\Competitions;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

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
        $values       = $this->getDadosEmissao($request);
        $competicao   = Competitions::find($values['id']);
        $atletas      = $this->getDadosParticipacao($values['id']);
        $titulo       = $values['titulo'];
        $informacoes  = $values['informacoes'];
        $descricao    = $values['descricao'];
        $observacoes  = $values['observacoes'];
        $apoiadores   = $values['apoiadores'];
        $obsfinais    = $values['obsfinais'];
        return view('competicoes.emissaorelatorio', [
             'competicao'   => $competicao
            ,'titulo'       => $titulo
            ,'descricao'    => $descricao
            ,'informacoes'  => $informacoes
            ,'observacoes'  => $observacoes
            ,'apoiadores'   => $apoiadores
            ,'obsfinais'    => $obsfinais
            ,'atletas'      => $atletas
        ]);
    }
    
    protected function getDadosEmissao(Request $request) {
        return $request->validate([
             'id'          => 'required'
            ,'titulo'      => 'required'
            ,'descricao'   => 'required'
            ,'informacoes' => ''
            ,'observacoes' => ''
            ,'apoiadores'  => ''
            ,'obsfinais'   => ''
        ], [], [
             'id' => 'Identificador do Relatório'
            ,'titulo' => 'Título do Relatório'
            ,'descricao' => 'Descrição do Relatório'
        ]);
    }
    
    protected function getDadosParticipacao($id) {
        return DB::table('athletes')
          ->join('competition_participation', 'athletes.id', '=', 'competition_participation.athletes_id')
          ->join('categories', 'categories.id', '=', 'competition_participation.categories_id')
          ->join('modalities', 'modalities.id', '=', 'competition_participation.modalities_id')
          ->where('competitions_id', $id)
          ->get();
    }
}
