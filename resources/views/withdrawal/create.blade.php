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
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Incluir Desistências</span>
                    <a class='btn btn-success btn-sm' href="{{ route('withdrawal.index', $team->id)}}"> Voltar</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('withdrawal.store')}}" method="POST">
                        @csrf

                        <label for="athlete"> Escolha o Atleta:</label>

                        <div class="form-group">
                            <input type="hidden" name="team" value="{{$team->id}}">
                            <select id="athlete"
                                class="form-control {{$errors->has('athlete_id') ? ' border-danger' : '' }}"
                                name="athlete">
                                <option>
                                </option>
                                @foreach($athletes as $athlete)
                                <option value='{{$athlete->athlete_id}}'>
                                    {{$athlete->athlete_id}} - {{$athlete->name}}
                                </option>;
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-sm-block btn-success">Adicionar</button>
                    </form>
                    @else

                    <p>Você não tem permissão para acessar essa funcionalidade.</p>

                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
