@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Faltas') }}</span>
                </div>

                <div class="card-body">
                    <form autocomplete="off" action="" method="get">

                        <div class="form-group">
                            <label id="titleAuxiliary">Periodo</label>

                            <div class="row" id='form-auxiliarys'>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateStart">Data Inicial</label>
                                        <input type="date" class="form-control" id="dateStart" name="dateStart">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateEnd">Data Final</label>
                                        <input type="date" class="form-control" id="dateEnd" name="dateEnd">
                                    </div>
                                </div>
                            </div>
                            <input class="btn btn-primary mt-2" type="submit" value="Filtrar">
                        </div>
                    </form>


                    <ul class="list-group">
                        @foreach($faults as $fault)
                        <li class="list-group-item text-center">
                            <a href="{{route('atletas.show', $fault->athlete_id)}}" title="Consultar"
                                class="align-items-start justify-content-between" style="display: flex">
                                <div>
                                    {{$fault->name}}
                                </div>
                                <div>
                                    Número de Faltas: {{$fault->faltas }}
                                </div>
                            </a>
                            <samp class="ml-1 text-danger">
                                {{$fault->faltas >= $faultLimit->limit ? 'Atleta não esta de acordo com a presença' :''}}
                            </samp>
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
