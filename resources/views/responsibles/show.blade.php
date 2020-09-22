@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes do responsável</span>
          <a class='btn btn-success btn-sm' href="/responsaveis">Voltar</a>
        </div>

        <div class="card-body">
          <p><b>Nome: </b>{{$responsible->user->name}}</p>
          <p><b>CPF: </b> {{$responsible->cpf}}</p>
          <p><b>Fone: </b> {{$responsible->phone}}</p>
          <p><b>Atletas: </b></p>
          <ul>
          @foreach($responsible->athletes as $athlete)
          <li>
            <b>Nome: {{$athlete->user->name}}</b>
            <p>RG: {{$athlete->rg}}</p>
          </li>
          @endforeach
          </ul>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection
