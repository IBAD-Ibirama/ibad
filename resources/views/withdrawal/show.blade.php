@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')


            <div class="card mt-3">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Desistências</span>
                    <div>
                        <a class='btn btn-primary btn-sm' href="{{route('withdrawal.create', $team->id)}}">Incluir</a>
                        <a class='btn btn-success btn-sm' href="/turmas/{{ $team->id }}">Voltar</a>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse($team->withdrawal as $withdrawal)

                        <li class="list-group-item">
                            <a>{{$withdrawal->name}} - {{$withdrawal->date}}</a>

                            <div class="float-right flex">
                                <form style="display: inline"
                                    action="{{ route('withdrawal.delete', ['team' => $team->id, 'withdrawal' => $withdrawal->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-outline-danger" type="submit" value="Excluir">
                                </form>
                            </div>
                        </li>
                        @empty
                        <h4>Nenhum atleta desistente nessa turma</h4>
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
