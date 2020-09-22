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
                        @if(count($training->frequencies()->get()) == 0)
                        <a class='btn btn-primary btn-sm' href="{{ route('frequency.create', $training->id)}}">Fazer
                            Chamada</a>
                        @else
                        <a class='btn btn-light btn-sm' href="{{ route('frequency.edit', $training->id)}}">Editar
                            Chamada</a>
                        @endif
                        <a class='btn btn-success btn-sm' href="{{ route('training.index') }}">Voltar</a>
                    </div>
                </div>

                <div class="card-body">
                    <h3><b>Turma - {{$training->team->name}}</b></h3>
                    <p>Data: {{ (new DateTime(substr($training->date,0,10)))->format('d/m/Y')}}</p>
                    <p>Local: {{ $training->local->description}}</p>
                    @forelse($helpers as $helper)
                    <p>Auxiliar: {{$helper->athlete->user->name}}</p>
                    @empty
                    <p>Treinador: {{$training->trainer->name}}</p>
                    <p>Nenhum auxiliar vinculado a esse treino</p>
                    @endforelse
                    <p>Dia da semana: {{$training->week_day}}</p>

                    <p>Horário: Início as {{$training->time_init}} até as {{$training->time_end}}</p>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endcan
        </div>
    </div>
</div>
@endsection
