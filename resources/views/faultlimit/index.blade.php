@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')
            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Limite de Faltas</span>
                    <a class='btn btn-success btn-sm' href="{{route('fault.create')}}">Definir Novo Limite de Faltas</a>
                </div>

                <div class="card-body">
                    <h3><b>O limite de faltas atual é de {{$faultLimit->limit}}</b></h3>
                    <p>Esse limite foi defino em: {{ $faultLimit->created_at->format('d-m-Y \a\s H:i')}}</p>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>
            <div class="text-center">
                <a href="/" class="btn btn-light">Voltar para Dashboard</a>
            </div>

            @endcan
        </div>
    </div>
</div>
@endsection
