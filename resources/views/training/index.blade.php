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
                        @foreach($trainings as $trainings)
                        <li class="list-group-item">
                            <a href="/treino/{{$trainings->id}}" title="Consultar">
                            {{ (new DateTime(substr($trainings->date,0,10)))->format('d/m/Y')}}</a>

                            {{-- <div class="float-right flex">
                                <a class="btn btn-sm btn-light mr-2" href="/turmas/{{$team->id}}/edit">Editar</a>

                            <form style="display: inline" action="turmas/{{$team->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-sm btn-outline-danger" type="submit" value="Deletar">
                            </form>
                </div> --}}
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
