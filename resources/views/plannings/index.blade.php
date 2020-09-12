@extends('layouts.master')

@section('title', 'Consultar Atividades')
@section('subtitle', $team->name . ' - Treino em ' . date('d/m/Y', strtotime($training->date)))

@section('content')
<div class="text-left">
    <a class="btn btn-secondary mb-1" href={{ route('index') }} role="button">Início</a>
    <a class="btn btn-primary mb-1" href={{ route('trainings.index', compact('team')) }} role="button">Voltar para Treinos</a>
    <a class="btn btn-success mb-1" href={{ route('plannings.create', compact('team', 'training')) }} role="button">Cadastrar</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="10%">#</th>
            <th scope="col" width="25%">Nome da Atividade</th>
            <th scope="col" width="45%">Descrição da Atividade</th>
            <th scope="col" width="20%">Ações</th>
        </tr>
        </thead>
        <tbody>
            @if (count($plannings) > 0)
                @foreach ($plannings as $planning)
                    <tr>
                        <th scope="row">{{ $planning->id }}</th>
                        <td>{{ $planning->name }}</td>
                        <td>{{ $planning->description }}</td>
                        <td>
                            <a class="btn btn-warning" href={{ route('plannings.edit', compact('team', 'training', 'planning')) }} role="button">Alterar</a>
                            <button class="btn btn-danger" onclick="document.getElementById('delete_{{ $planning->id }}').submit()">Excluir</button>
                            <form id="delete_{{ $planning->id }}" action={{ route('plannings.destroy', compact('planning')) }} method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Nenhuma atividade cadastrada</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection