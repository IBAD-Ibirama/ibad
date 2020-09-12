@extends('layouts.master')

@section('title', 'Consultar Turmas')

@section('content')
<div class="text-left">
    <a class="btn btn-secondary mb-1" href={{ route('index') }} role="button">Início</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="10%">#</th>
            <th scope="col" width="80%">Nome da Turma</th>
            <th scope="col" width="10%">Ações</th>
        </tr>
        </thead>
        <tbody>
            @if (count($teams) > 0)
                @foreach ($teams as $team)
                    <tr>
                        <th scope="row">{{ $team->id }}</th>
                        <td>{{ $team->name }}</td>
                        <td>
                            <a class="btn btn-primary" href={{ route('trainings.index', compact('team')) }} role="button">Treinos</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Nenhuma turma cadastrada</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection