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
});
