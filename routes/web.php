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
Route::get('competicoes/relatorio', 'CompetitionsReportController@index');
Route::post('competicoes/relatorio', 'CompetitionsReportController@emit');
Route::get('/atletas/desempenho/{id}', 'AthletesCompetitionController@show');
Route::get('/financeiro', 'FinancesController@index');
