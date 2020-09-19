@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Detalhes do treino</span>
                    <div>
                        <a class='btn btn-primary btn-sm'
                            href="{{ route('frequency.create', $training->id)}}">Chamada</a>
                        <a class='btn btn-success btn-sm' href="{{ route('training.index') }}">Voltar</a>
                    </div>
                </div>

                <div class="card-body">
                    {{--  <h3><b>{{$team->name}}</b></h3>
                    <p>Nível da Turma: {{ $team->teamLevel->name}}</p>
                    <p>Esta turma {{ $team->teamLevel->requires_auxiliary ? '' : 'não' }} requer auxiliares</p>
                    <p>Os atletas dessa turma {{ $team->teamLevel->can_be_auxiliary ? '' : 'não' }} podem ser auxiliares
                    </p> --}}
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endcan
        </div>
    </div>
</div>
@endsection
