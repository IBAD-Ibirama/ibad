@extends('layouts.master')

@section('title', 'IBAD')

@section('content')
    <div class="card-deck row d-flex justify-content-center">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Atletas</div>
            <div class="card-body">
                <h5 class="card-title">Cadastro de atletas</h5>
                <p class="card-text">Consultar, inserir, alterar e excluir atletas.</p>
                <a href={{ route('athletes.index') }} class="btn btn-success stretched-link">Clique para abrir</a>
            </div>
        </div>
    </div>
@endsection