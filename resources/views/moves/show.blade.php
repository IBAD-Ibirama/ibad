@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Move Detail') }}</div>
                    <div class="card-body">
                        <b>{{$moves->id}}</b>
                        <p>Descricao: {{$moves->descricao}}</p>
                        <p>Data: {{$moves->data}}</p>
                        <p>Tipo: {{$moves->tipo}}</p>
                        <p>Valor: {{$moves->valor}}</p>
                        <p>Especificação: {{$moves->especificacao}}</p>
                    </div>
            </div>
            <div class="mt-2">
                <a class='btn btn-success btn-sm' href="/moves">Back to overview</a>
            </div>
        </div>
    </div>
</div>
@endsection