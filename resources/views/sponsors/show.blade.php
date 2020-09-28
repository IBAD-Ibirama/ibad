@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('financeiro')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes do patrocinador</span>
          <a class='btn btn-success btn-sm' href="/patrocinadores">Voltar</a>
        </div>

        <div class="card-body">
          <p><b>CNPJ: </b>{{ $sponsors->cnpj }}</p>
          <p><b>Nome: </b> {{ $sponsors->name }}</p>
          <p><b>Email: </b> {{ $sponsors->email }}</p>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection