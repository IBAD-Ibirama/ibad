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

    Route::get('competicoes/relatorio', 'CompetitionsReportController@index');
    Route::post('competicoes/relatorio', 'CompetitionsReportController@emit');
    Route::get('/atleta/desempenho', 'AthletesCompetitionController@showAll');
    Route::get('/atleta/dados', 'QueryAthelteController@show');
    Route::get('/atleta/desempenho/{id}', 'AthletesCompetitionController@show');
    Route::get('/financeiro', 'FinancesController@index');

    //competicoes
    Route::get('competicao', 'CompetitionController@index');
    Route::get('competicao/cadastrar', 'CompetitionController@formCadastro');
    Route::get('competicao/alterar/{id}', 'CompetitionController@formAlterar');
    Route::post('competicao/atualizar', 'CompetitionController@update');
    Route::post('competicao/criar', 'CompetitionController@create');
    Route::get('competicao/remove/{id}', 'CompetitionController@destroy');

    //Registro da participação em competição
    Route::get('atleta/registroPraticipacaoAtleta', 'RegisterAthleteCompetitionController@index');
    Route::get('atleta/registroPraticipacaoAtleta/registra', 'RegisterAthleteCompetitionController@formCadastrar');
    Route::post('atleta/registroPraticipacaoAtleta/registrar', 'RegisterAthleteCompetitionController@store');
    Route::get('atleta/registroPraticipacaoAtleta/alterar/{id}', 'RegisterAthleteCompetitionController@formAlterar');
    Route::post('atleta/registroPraticipacaoAtleta/atualizar', 'RegisterAthleteCompetitionController@update');
    Route::get('atleta/registroPraticipacaoAtleta/remove/{id}', 'RegisterAthleteCompetitionController@destroy');

    //Frequencia Atleta
    Route::get('frequencia', 'FrequencyAthlete@index');
});
