<?php

namespace App\Http\Controllers\Grupo5;

use App\Grupo5\Model\Atletas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class AtletasController extends Controller
{

    private $atletas;

    public function __construct()
    {
        $this->atletas = new Atletas();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grupo5.atletas.desempenho');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            ->where('atleta_id', $id)
            ->get();

        // dd($participacoesAtleta);
        // die;

        return view('grupo5.atletas.desempenho', compact('participacoesAtleta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grupo5\Model\Atletas  $atletas
     * @return \Illuminate\Http\Response
     */
    public function edit(Atletas $atletas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo5\Model\Atletas  $atletas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atletas $atletas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo5\Model\Atletas  $atletas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atletas $atletas)
    {
        //
    }
}
