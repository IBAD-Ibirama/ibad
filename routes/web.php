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

    Route::get('/turmas/{team}/matricular', 'MatriculateController@create')
        ->name('team.matriculate')
        ->where('id', '[0-9]+');

    Route::post('/turmas/{team}/matricular', 'MatriculateController@store')
        ->where('team', '[0-9]+')
        ->name('athlete.matriculate');

    Route::delete('/turmas/{team}/atleta/{athlete}', 'MatriculateController@destroy')
        ->name('team.dematriculate')
        ->where('team', '[0-9]+')
        ->where('athlete', '[0-9]+');

    Route::model('training', 'App\Training');

    Route::get('/treinos', 'TrainingController@index')
        ->name('training.index')
        ->where('team', '[0-9]+');

    Route::get('/treinos/create', 'TrainingController@create')
        ->name('training.create')
        ->where('team', '[0-9]+');

    Route::post('/training/cadastrar', 'TrainingController@store')
        ->name('training.store')
        ->where('id', '[0-9]+');
  

    Route::get('/treino/{training}', 'TrainingController@show')
        ->name('training.show')
        ->where('training', '[0-9]+');

    Route::get('/treino/{training}/frequencia', 'FrequencyController@create')
        ->name('frequency.create')
        ->where('training', '[0-9]+');

    Route::post('/turma/{training}/frequencia', 'FrequencyController@store')
        ->name('frequency.store')
        ->where('training', '[0-9]+');


    Route::get('/turma/{training}/frequencia/edit', 'FrequencyController@edit')
        ->name('frequency.edit')
        ->where('training', '[0-9]+');

    Route::put('/turma/{training}/frequencia', 'FrequencyController@update')
        ->name('frequency.update')
        ->where('training', '[0-9]+');

});
