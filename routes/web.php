<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

//Turmas
Route::get('/turmas', 'TeamController@index')->name('teams.index');
//Turmas x Treinos
Route::get('/turmas/{team}/treinos', 'TrainingController@index')->name('trainings.index');
//Turmas x Treinos x Atividades
Route::get('/turmas/{team}/treinos/{training}/atividades', 'PlanningController@index')->name('plannings.index');
Route::get('/turmas/{team}/treinos/{training}/atividades/create', 'PlanningController@create')->name('plannings.create');
Route::get('/turmas/{team}/treinos/{training}/atividades/{planning}/edit', 'PlanningController@edit')->name('plannings.edit');
Route::post('/turmas/treinos/atividades', 'PlanningController@store')->name('plannings.store');
Route::put('/turmas/treinos/atividades/{planning}', 'PlanningController@update')->name('plannings.update');
Route::delete('/turmas/treinos/atividades/{planning}', 'PlanningController@destroy')->name('plannings.destroy');