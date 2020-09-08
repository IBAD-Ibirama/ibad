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