<?php

namespace App\Http\Controllers\Grupo5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
}
