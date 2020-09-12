@extends('layouts.master')

@section('title', 'Consultar Treinos')
@section('subtitle', $team->name)

@section('content')
<div class="text-left">
    <a class="btn btn-secondary mb-1" href={{ route('index') }} role="button">Início</a>
    <a class="btn btn-primary mb-1" href={{ route('teams.index') }} role="button">Voltar para Turmas</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="10%">#</th>
            <th scope="col" width="80%">Data do Treino</th>
            <th scope="col" width="10%">Ações</th>
        </tr>
        </thead>
        <tbody>
            @if (count($trainings) > 0)
                @foreach ($trainings as $training)
                    <tr>
                        <th scope="row">{{ $training->id }}</th>
                        <td>{{ $training->date }}</td>
                        <td>
                            <a class="btn btn-primary" href={{ route('plannings.index', compact('team', 'training')) }} role="button">Atividades</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Nenhum treino cadastrado</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection