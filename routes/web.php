<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/relatorio-movimentacoes', 'MovesReportController@create');

Route::middleware('auth')->group(function () {
    Route::resource('usuarios', 'UserController');
    Route::resource('movimentacoes', 'MovesController');
    Route::resource('patrocinadores', 'SponsorController');
    Route::resource('atletas', 'AthleteController');
});

Route::get('/delete-images/athlete/{athlete_id}', 'AthleteController@deleteImages');
