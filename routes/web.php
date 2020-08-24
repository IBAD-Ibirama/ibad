<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::resource('usuarios', 'UserController');
Route::resource('moves','MovesController');

Route::get('/dashboard', 'HomeController@index')->name('home');
