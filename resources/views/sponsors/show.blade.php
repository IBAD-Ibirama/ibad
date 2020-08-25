@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes do pagamento de patrocinador</span>
          <a class='btn btn-success btn-sm' href="/usuarios">Voltar</a>
        </div>

        <div class="card-body">
          <p><b>{{$sponsors->cnpj}}</b></p>
          <p>Valor: {{$sponsors->value}}</p>
          <p>Email: {{$sponsors->email}}</p>
          <p>Permissão: {{ $roles[0] }}</p>

        </div>
      </div>

      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole

    </div>
  </div>
</div>
@endsection