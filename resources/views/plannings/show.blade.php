@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('treinador')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $training->description() }} - Visualizar Atividade</span>
          <a class="btn btn-warning btn-sm" href="{{ route('plannings.index', compact('team', 'training')) }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <div class="col-md-9">
            <p class="mt-4">Nome: {{ $planning->name }}</p>
            <p>Descrição: {{ $planning->description }}</p>
          </div>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection