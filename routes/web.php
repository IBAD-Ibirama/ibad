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
//competicoes
Route::get('competicao'             , 'CompetitionController@index');
Route::get('competicao/cadastrar'   , 'CompetitionController@formCadastro');
Route::get('competicao/alterar/{id}', 'CompetitionController@formAlterar');
Route::post('competicao/atualizar'  , 'CompetitionController@update');
Route::post('competicao/criar'      , 'CompetitionController@create');
Route::get('competicao/remove/{id}' , 'CompetitionController@destroy');

