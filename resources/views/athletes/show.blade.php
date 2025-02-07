@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  <div class="row justify-content-center">
    <div class="col-md-11">
      @can('treinador')

      <div class="card">

        <div class="card-header">{{$athlete->user->name}}
          <a class="btn btn-warning btn-sm float-right ml-2" href="{{ route('atletas.index') }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
          <a class='btn btn-outline-primary btn-sm float-right' href="{{ route('evolution-charts.index', compact('athlete')) }}">Gráficos de Evolução</a>
        </div>

        <div class="col-md-3">
          @if(Auth::user() && file_exists('images/athletes/'. $athlete->id . '_large.jpg'))
          <a href="/images/athletes/{{$athlete->id}}_large.jpg" data-lightbox="images/athletes/{{$athlete->id}}_large.jpg" data-title="{{ $athlete->name }}">
            <img class="img-fluid mt-4" src="/images/athletes/{{$athlete->id}}_large.jpg" alt="">
          </a>
          @endif
          @if(!Auth::user() && file_exists('images/athletes/'. $athlete->id . '_pixelated.jpg'))
          <img class="img-fluid" src="/images/athletes/{{$athlete->id}}_pixelated.jpg" alt="">
          @endif
        </div>
        <div class="col-md-9">
          <p class="mt-4">Data de Nascimento: {{$athlete->birthdate}}</p>
          <p>Sexo: {{$athlete->gender}}</p>
          <p>RG: {{$athlete->rg}}</p>
          <p>Telefone: {{$athlete->telephone}}</p>
          <p>Período: {{$athlete->shift}}</p>
          <p>Série: {{$athlete->grade}}</p>
          <p>Problema de Saúde: {{$athlete->health_problem}}</p>
          <p>Medicação: {{$athlete->medication}}</p>
          <p>Tamanho do Uniforme: {{$athlete->cloth_size}}</p>
          <p>Tipo Sanguíneo: {{$athlete->blood_type}}</p>
          <p>Escola: {{$athlete->school}}</p>
        </div>

      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection
