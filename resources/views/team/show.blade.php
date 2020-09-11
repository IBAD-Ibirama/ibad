@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes da turma</span>
          <a class='btn btn-success btn-sm' href="/turmas">Voltar</a>
        </div>

        <div class="card-body">
          <h3><b>{{$team->name}}</b></h3>
          <p>Nivel da Turma: {{ $team->teamLevel->name}}</p>
          <p>Esta turma {{ $team->teamLevel->requires_auxiliary ? '' : 'não' }} requer auxiliares</p>
          <p>Os atletas dessa turma {{ $team->teamLevel->can_be_auxiliary ? '' : 'não' }} podem ser auxiliares</p>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole
    </div>
  </div>
</div>
@endsection
