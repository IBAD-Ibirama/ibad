<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

//Atletas
Route::get('/atletas', 'AthleteController@index')->name('athletes.index');
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

//Turmas
Route::get('/turmas', 'TeamController@index')->name('teams.index');
//Turmas x Treinos
Route::get('/turmas/{team}/treinos', 'TrainingController@index')->name('trainings.index');
//Turmas x Treinos x Atividades
Route::get('/turmas/{team}/treinos/{training}/atividades', 'PlanningController@index')->name('plannings.index');
Route::get('/turmas/{team}/treinos/{training}/atividades/create', 'PlanningController@create')->name('plannings.create');
Route::get('/turmas/{team}/treinos/{training}/atividades/{planning}/edit', 'PlanningController@edit')->name('plannings.edit');
Route::post('/turmas/treinos/atividades', 'PlanningController@store')->name('plannings.store');
Route::put('/turmas/treinos/atividades/{planning}', 'PlanningController@update')->name('plannings.update');
Route::delete('/turmas/treinos/atividades/{planning}', 'PlanningController@destroy')->name('plannings.destroy');
