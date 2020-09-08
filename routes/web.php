<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::resource('avaliacao_atleta', 'AthleteEvaluationController');
=======
Route::resource('avaliacao_atleta', 'AthleteEvaluationController');

Route::get('evolucao-atleta', 'AthleteEvaluationChartController@index');
Route::get('evolucao-atleta/ajax/indices-corporais', 'AthleteEvaluationChartController@bodyIndexChartAjax')->name('charts.evolucao-atleta-ajax-indices-corporais');
Route::get('evolucao-atleta/ajax/testes-fisicos', 'AthleteEvaluationChartController@physicalTestChartAjax')->name('charts.evolucao-atleta-ajax-testes-fisicos');
>>>>>>> 45d288f5edbf700131b4ea6408c72e1532d89721
