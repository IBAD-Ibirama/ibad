@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      @role('admin')

      <div class="card">
        
        <div class="card-header">{{$athlete->user->name}}
            <a class='btn btn-success btn-sm float-right' href="/atletas">Voltar</a>
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
          <p class="mt-4">Data de Nascimento: {{$athlete->dataNasc}}</p>
          <p>Sexo: {{$athlete->sexo}}</p>
          <p>Rg: {{$athlete->rg}}</p>
          <p>Fone: {{$athlete->fone}}</p>
          <p>Periodo: {{$athlete->periodo}}</p>
          <p>Serie: {{$athlete->serie}}</p>
          <p>Problema de Saude: {{$athlete->problemaSaude}}</p>
          <p>Medicacao: {{$athlete->medicacao}}</p>
          <p>Tamanho Uniforme: {{$athlete->tamanhoUniforme}}</p>
          <p>Tipo Sanguineo: {{$athlete->tipoSangue}}</p>
          <p>Escola: {{$athlete->escola}}</p>
        </div>
        
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole
    </div>
  </div>
</div>
@endsection
