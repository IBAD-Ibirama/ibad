@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Detalhes da turma</span>
                    <a class='btn btn-success btn-sm' href="/turmas">Voltar</a>
                </div>

                <div class="card-body">
                    <h3><b>{{$team->name}}</b></h3>
                    <p>Nível da Turma: {{ $team->teamLevel->name}}</p>
                    <p>Esta turma {{ $team->teamLevel->requires_auxiliary ? '' : 'não' }} requer auxiliares</p>
                    <p>Os atletas dessa turma {{ $team->teamLevel->can_be_auxiliary ? '' : 'não' }} podem ser auxiliares
                    </p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Atletas da Turma</span>
                    <a class='btn btn-success btn-sm' href="{{route('team.matriculate', $team->id)}}">Vincular
                        Atleta</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse($team->athletes as $athlete)
                        <li class="list-group-item">
                            <a href="/atletas/{{$athlete->athlete_id}}" title="Consultar">{{$athlete->name}}</a>

                            <div class="float-right flex">
                                <form style="display: inline"
                                    action="{{ route('team.dematriculate', ['team' => $team->id, 'athlete' => $athlete->athlete_id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-outline-danger" type="submit" value="Desmatricular">
                                </form>
                            </div>
                        </li>
                        @empty
                        <h4>Nenhum atleta matriculado nessa turma</h4>
                        @endforelse
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
