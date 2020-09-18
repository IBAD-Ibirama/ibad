<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::resource('usuarios', 'UserController');
    Route::resource('movimentacoes', 'MovesController');
    Route::resource('patrocinadores', 'SponsorController');
    Route::resource('atletas', 'AthleteController');
    Route::get('/relatorio-movimentacoes', 'MovesReportController@create');
    Route::get('/delete-images/athlete/{athlete_id}', 'AthleteController@deleteImages');


    Route::model('team', 'App\Team');

    Route::resource('turmas', 'TeamController');
    Route::model('athlete', 'App\Athlete');

    Route::get('/turmas/{team}/matricula', 'MatriculateController@create')
      ->name('team.matriculate')
      ->where('id', '[0-9]+');

    Route::post('/turmas/{team}/matricular', 'MatriculateController@store')
      ->where('team', '[0-9]+')
      ->name('athlete.matriculate');

    Route::delete('/turmas/{team}/atleta/{athlete}', 'MatriculateController@destroy')
      ->name('team.dematriculate')
      ->where('team', '[0-9]+')
      ->where('athlete', '[0-9]+');
    
    //Atletas x Avaliações
    Route::get('/atletas/{athlete}/avaliacoes', 'AthleteEvaluationController@index')->name('evaluations.index');
    Route::get('/atletas/{athlete}/avaliacoes/create', 'AthleteEvaluationController@create')->name('evaluations.create');
    Route::get('/atletas/{athlete}/avaliacoes/{evaluation}/edit', 'AthleteEvaluationController@edit')->name('evaluations.edit');
    Route::post('/atletas/avaliacoes', 'AthleteEvaluationController@store')->name('evaluations.store');
    Route::put('/atletas/avaliacoes/{evaluation}', 'AthleteEvaluationController@update')->name('evaluations.update');
    Route::delete('/atletas/avaliacoes/{evaluation}', 'AthleteEvaluationController@destroy')->name('evaluations.destroy');
    
    //Atletas x Evolução
    Route::get('/atletas/{athlete}/graficos-evolucao', 'AthleteEvaluationChartController@index')->name('evolution-charts.index');
    Route::get('evolucao-atleta/ajax/indices-corporais', 'AthleteEvaluationChartController@bodyIndexChartAjax')->name('charts.evolucao-atleta-ajax-indices-corporais');
    Route::get('evolucao-atleta/ajax/testes-fisicos', 'AthleteEvaluationChartController@physicalTestChartAjax')->name('charts.evolucao-atleta-ajax-testes-fisicos');
    
    //Turmas x Treinos x Atividades
    Route::get('/turmas/{team}/treinos/{training}/atividades', 'PlanningController@index')->name('plannings.index');
    Route::get('/turmas/{team}/treinos/{training}/atividades/create', 'PlanningController@create')->name('plannings.create');
    Route::get('/turmas/{team}/treinos/{training}/atividades/{planning}/edit', 'PlanningController@edit')->name('plannings.edit');
    Route::post('/turmas/treinos/atividades', 'PlanningController@store')->name('plannings.store');
    Route::put('/turmas/treinos/atividades/{planning}', 'PlanningController@update')->name('plannings.update');
    Route::delete('/turmas/treinos/atividades/{planning}', 'PlanningController@destroy')->name('plannings.destroy');
});
