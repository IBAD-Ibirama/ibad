<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::resource('usuarios', 'UserController');
Route::resource('moves','MovesController');

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/moves-report', 'MovesReportController@create');

Route::middleware('auth')->group(function () {
    Route::resource('sponsors', 'SponsorController');
});
