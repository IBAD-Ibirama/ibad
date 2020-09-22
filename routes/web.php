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
    Route::get('/recibo-movimentacoes/{id}', 'MovesReceiptController@create');
    Route::get('/delete-images/athlete/{athlete_id}', 'AthleteController@deleteImages');



    Route::resource('turmas', 'TeamController');

    Route::model('athlete', 'App\Athlete');
    Route::model('team', 'App\Team');
    Route::model('training', 'App\Training');

    /* Rotas de Matricula */
    Route::get('/turmas/{team}/matricular', 'MatriculateController@create')
    ->name('team.matriculate')
    ->where('team', '[0-9]+');

    Route::post('/turmas/{team}/matricular', 'MatriculateController@store')
    ->where('team', '[0-9]+')
    ->name('athlete.matriculate');

    Route::delete('/turmas/{team}/atleta/{athlete}', 'MatriculateController@destroy')
    ->name('team.dematriculate')
    ->where('team', '[0-9]+')
    ->where('athlete', '[0-9]+');

    /* Rotas de treino */
    Route::get('/treinos', 'TrainingController@index')
        ->name('training.index')
        ->where('team', '[0-9]+');

    Route::get('/treinos/create', 'TrainingController@create')
        ->name('training.create')
        ->where('team', '[0-9]+');

    Route::post('/treino', 'TrainingController@store')
        ->name('training.store')
        ->where('id', '[0-9]+');

    Route::get('/treino/{training}', 'TrainingController@show')
        ->name('training.show')
        ->where('training', '[0-9]+');

    Route::get('/treino/{training}/edit', 'TrainingController@edit')
        ->name('training.edit')
        ->where('training', '[0-9]+');

    Route::put('/treino/{training}', 'TrainingController@update')
        ->name('training.update')
        ->where('training', '[0-9]+');

    Route::delete('/treinos/{training}', 'TrainingController@destroy')
        ->name('training.destroy')
        ->where('training', '[0-9]+');

    /* Rotas de Frequencia */
    Route::get('/treino/{training}/frequencia', 'FrequencyController@create')
        ->name('frequency.create')
        ->where('training', '[0-9]+');

    Route::post('/treino/{training}/frequencia', 'FrequencyController@store')
        ->name('frequency.store')
        ->where('training', '[0-9]+');

    Route::get('/treino/{training}/frequencia/edit', 'FrequencyController@edit')
        ->name('frequency.edit')
        ->where('training', '[0-9]+');

    Route::put('/treino/{training}/frequencia', 'FrequencyController@update')
        ->name('frequency.update')
        ->where('training', '[0-9]+');

    /*Rotas deLimite de Faltas */
    Route::get('/limiteDeFaltas', 'FaultLimitController@index')
        ->name('fault.show');

    Route::get('/limiteDeFaltas/edit', 'FaultLimitController@create')
        ->name('fault.create');

    Route::post('/limiteDeFaltas', 'FaultLimitController@store')
        ->name('fault.store');

});
