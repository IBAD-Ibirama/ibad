@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Todos os treinos') }}</span>
                    <a class='btn btn-success btn-sm' href="/treinos/create">Criar novo treino</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($trainings as $training)
                        <li class="list-group-item">
                            <a href="{{ route('training.show', $training->id) }}" title="Consultar">
                                {{$training->team->name}} -
                                {{ (new DateTime(substr($training->date,0,10)))->format('d/m/Y')}} -
                                {{ $training->week_day }} -
                                {{ $training->time_init}} as {{ $training->time_end}}
                            </a>
                            <div class="float-right flex">
                                <a class="btn btn-sm btn-light mr-2"
                                    href="{{ route('training.edit', $training->id) }}">Editar</a>
                                <form style="display: inline" action="{{ route('training.destroy', $training->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-outline-danger" type="submit" name="_method"
                                        value="delete">
                                </form>
                            </div>
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
