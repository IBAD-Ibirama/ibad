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

//Registro da participação em competição
Route::get('atletas/registerAthleteCompetition'          , 'registerAthleteCompetitionController@index');
Route::get('atletas/registro'                            , 'registerAthleteCompetitionController@formCadastrar');
Route::post('atletas/registerAthleteCompetition/register', 'registerAthleteCompetitionController@store');

//Frequencia Atleta
Route::get('frequencia','FrequencyAthlete@index');
