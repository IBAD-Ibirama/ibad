<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('competicoes/relatorio', 'Grupo5\RelatorioCompeticoesController');
Route::get('/atletas/desempenho/{id}', 'Grupo5\AtletasController@show');
Route::get('/financeiro', 'Grupo5\FinanceiroController@index');
