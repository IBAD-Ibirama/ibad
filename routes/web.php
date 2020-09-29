<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::resource('responsaveis', 'ResponsibleController');
    Route::get('/relatorio-movimentacoes', 'MovesReportController@create');
    Route::get('/recibo-movimentacoes/{id}', 'MovesReceiptController@create');
    Route::get('/delete-images/athlete/{athlete_id}', 'AthleteController@deleteImages');

    Route::resource('turmas', 'TeamController');

    Route::model('athlete', 'App\Athlete');
    Route::model('team', 'App\Team');
    Route::model('training', 'App\Training');
    Route::model('withdrawal', 'App\Withdrawal');

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
    Route::get('/frequencias', 'FrequencyController@index')
    ->name('frequency.index');

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

    /* Rotas de Desistencia */
    Route::get('/turma/{team}/desistencias', 'WithdrawalController@index')
        ->name('withdrawal.index')
        ->where('team', '[0-9]+');

    Route::get('/turma/{team}/desistencia/create', 'WithdrawalController@create')
        ->name('withdrawal.create')
        ->where('team', '[0-9]+');

    Route::post('/turma/desistencia', 'WithdrawalController@store')
        ->name('withdrawal.store');

    Route::delete('/turmas/{team}/withdrawal/{withdrawal}', 'WithdrawalController@destroy')
        ->name('withdrawal.delete')
        ->where('team', '[0-9]+')
        ->where('withdrawal', '[0-9]+');

    /* Rotas de Limite de Faltas */
    Route::get('/limiteDeFaltas', 'FaultLimitController@index')
        ->name('fault.show');

    Route::get('/limiteDeFaltas/edit', 'FaultLimitController@create')
        ->name('fault.create');

    Route::post('/limiteDeFaltas', 'FaultLimitController@store')
        ->name('fault.store');

    //Atletas x Avaliações
    Route::get('/atletas/{athlete}/avaliacoes', 'AthleteEvaluationController@index')->name('evaluations.index');
    Route::get('/atletas/{athlete}/avaliacoes/create', 'AthleteEvaluationController@create')->name('evaluations.create');
    Route::get('/atletas/{athlete}/avaliacoes/{evaluation}/show', 'AthleteEvaluationController@show')->name('evaluations.show');
    Route::get('/atletas/{athlete}/avaliacoes/{evaluation}/edit', 'AthleteEvaluationController@edit')->name('evaluations.edit');
    Route::post('/atletas/avaliacoes', 'AthleteEvaluationController@store')->name('evaluations.store');
    Route::put('/atletas/avaliacoes/{evaluation}', 'AthleteEvaluationController@update')->name('evaluations.update');
    Route::delete('/atletas/avaliacoes/{evaluation}', 'AthleteEvaluationController@destroy')->name('evaluations.destroy');
    
    //Atletas x Evolução
    Route::get('/atletas/{athlete}/graficos-evolucao', 'AthleteEvaluationChartController@index')->name('evolution-charts.index');
    Route::get('evolucao-atleta/ajax/indices-corporais', 'AthleteEvaluationChartController@bodyIndexChartAjax')->name('charts.evolucao-atleta-ajax-indices-corporais');
    Route::get('evolucao-atleta/ajax/testes-fisicos', 'AthleteEvaluationChartController@physicalTestChartAjax')->name('charts.evolucao-atleta-ajax-testes-fisicos');
    
    //Turmas x Treinos x Atividades
    Route::get('/turmas/{team}/treinos/{training}/atividades', 'PlanningController@index')->name('plannings.index');
    Route::get('/turmas/{team}/treinos/{training}/atividades/create', 'PlanningController@create')->name('plannings.create');
    Route::get('/turmas/{team}/treinos/{training}/atividades/{planning}/show', 'PlanningController@show')->name('plannings.show');
    Route::get('/turmas/{team}/treinos/{training}/atividades/{planning}/edit', 'PlanningController@edit')->name('plannings.edit');
    Route::post('/turmas/treinos/atividades', 'PlanningController@store')->name('plannings.store');
    Route::put('/turmas/treinos/atividades/{planning}', 'PlanningController@update')->name('plannings.update');
    Route::delete('/turmas/treinos/atividades/{planning}', 'PlanningController@destroy')->name('plannings.destroy');

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

});