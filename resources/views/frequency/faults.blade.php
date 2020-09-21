@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Faltas') }}</span>
                    <a class='btn btn-success btn-sm' href="/turmas/{{ $team->id }}">voltar</a>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <form autocomplete="off" action="{{ route('frequency.faults', $team->id) }}" method="get">
                            <label for="dateStart">Data Inicial</label>
                            <input type="date" class="form-control" id="dateStart" name="dateStart">

                            <label for="dateEnd">Data Final</label>
                            <input type="date" class="form-control" id="dateEnd" name="dateEnd">

                            <label for="school">Atleta</label>
                            <select name="athlete" id="athlete" class="form-control">
                                <option value="0"></option>
                                @foreach($team->faults as $faults)
                                <option value="{{$faults->name}}">{{$faults->name}}</option>
                                @endforeach
                            </select>

                            <input class="btn btn-primary mt-4" type="submit" value="Filtrar">
                        </form>
                    </div>


                    <ul class="list-group">
                        @foreach($team->faults as $faults)
                        <li class="list-group-item">
                            <a href="" title="Consultar">{{$faults->name}} - {{$faults->date}}</a>
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