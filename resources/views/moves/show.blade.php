@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes da movimentação</span>
          <a class='btn btn-success btn-sm' href="/movimentacoes">Voltar</a>
        </div>

        <div class="card-body">
          <p>Descrição: {{$moves->descricao}}</p>
          <p>Data: {{$moves->data}}</p>
          <p>Tipo: {{$moves->tipo}}</p>
          <p>Valor: {{$moves->valor}}</p>
          <p>Especificação: {{$moves->especificacao}}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
