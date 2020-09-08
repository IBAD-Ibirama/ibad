<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\AthleteEvaluationBodyIndexChart;
use App\Charts\AthleteEvaluationPhysicalTestChart;
use App\Athlete;
use App\BodyIndex;
use App\PhysicalTest;

class AthleteEvaluationChartController extends Controller
{
    /**
     * Exibe a tela com os graficos de evolucao.
     *
     * @param  \App\Athlete $athlete
     * @return \Illuminate\Http\Response
     */
    public function index(Athlete $athlete)
    {
        $bodyIndexes = BodyIndex::all()->sortBy('name');
        $physicalTests = PhysicalTest::all()->sortBy('name');
        return view('athlete_evaluation_chart.index', compact('athlete', 'bodyIndexes', 'physicalTests'));
    }

    /**
     * Busca os dados para o grafico de indices corporais.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bodyIndexChartAjax(Request $request)
    {
        $chart = new AthleteEvaluationBodyIndexChart;
  
        return $chart->handler($request)->toJSON();   
    }

    /**
     * Busca os dados para o grafico de testes fisicos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function physicalTestChartAjax(Request $request)
    {
        $chart = new AthleteEvaluationPhysicalTestChart;
  
        return $chart->handler($request)->toJSON();   
    }
}
