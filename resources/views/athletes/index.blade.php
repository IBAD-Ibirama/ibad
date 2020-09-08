@extends('layouts.master')

@section('title', 'Consultar Atletas')

@section('content')
<div class="text-left">
    <a class="btn btn-secondary mb-1" href={{ route('index') }} role="button">Início</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="10%">#</th>
            <th scope="col" width="65%">Nome do Atleta</th>
            <th scope="col" width="25%">Ações</th>
        </tr>
        </thead>
        <tbody>
            @if (count($athletes) > 0)
                @foreach ($athletes as $athlete)
                    <tr>
                        <th scope="row">{{ $athlete->id }}</th>
                        <td>{{ $athlete->name }}</td>
                        <td>
                            <a class="btn btn-primary" href={{ route('evaluations.index', compact('athlete')) }} role="button">Avaliações</a>
                            <a class="btn btn-warning" href={{ route('evolution-charts.index', compact('athlete')) }} role="button">Gráficos de Evolução</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Nenhum atleta cadastrado</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection