@extends('layouts.master')

@section('title', 'Consultar Avaliações')
@section('subtitle', $athlete->name)

@section('content')
<div class="text-left">
    <a class="btn btn-secondary mb-1" href={{ route('index') }} role="button">Início</a>
    <a class="btn btn-primary mb-1" href={{ route('athletes.index') }} role="button">Voltar para Atletas</a>
    <a class="btn btn-success mb-1" href={{ route('evaluations.create', compact('athlete')) }} role="button">Cadastrar</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="10%">#</th>
            <th scope="col" width="30%">Data da Avaliação</th>
            <th scope="col" width="20%">Testes Físicos</th>
            <th scope="col" width="20%">Índices Corporais</th>
            <th scope="col" width="20%">Ações</th>
        </tr>
        </thead>
        <tbody>
            @if (count($evaluations) > 0)
                @foreach ($evaluations as $evaluation)
                    <tr>
                        <th scope="row">{{ $evaluation->id }}</th>
                        <td>{{ date('d/m/Y', strtotime($evaluation->realization_date)) }}</td>
                        <td>{{ $evaluation->physicalTests()->count() }}</td>
                        <td>{{ $evaluation->bodyIndexes()->count() }}</td>
                        <td>
                            <a class="btn btn-warning" href={{ route('evaluations.edit', compact('athlete', 'evaluation')) }} role="button">Alterar</a>
                            <button class="btn btn-danger" onclick="document.getElementById('delete_{{ $evaluation->id }}').submit()">Excluir</button>
                            <form id="delete_{{ $evaluation->id }}" action={{ route('evaluations.destroy', compact('evaluation')) }} method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Nenhuma avaliação cadastrada</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection