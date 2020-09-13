@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('financeiro')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes da movimentação</span>
          <a class='btn btn-success btn-sm' href="/movimentacoes">Voltar</a>
        </div>

        <div class="card-body">
          <p>Descrição: {{$moves->description}}</p>
          <p>Data: {{$moves->date}}</p>
          <p>Tipo: {{$moves->type}}</p>
          <p>Valor: {{$moves->value}}</p>
          <p>Especificação: {{$moves->specification}}</p>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection
