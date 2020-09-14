@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('admin')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Consulta de participação</span>
                    <a class='btn btn-success btn-sm' href="/atleta/registroPraticipacaoAtleta/registra">Registrar Participação</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Atleta</th>
                                <th scope="col">Data</th>
                                <th scope="col">Local</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Modalidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($athletesCompetitions as $competition)
                            <tr>
                                <td>{{$competition->name}}</td>
                                <td>{{$competition->date}}</td>
                                <td>{{$competition->place}}</td>
                                <td>{{$competition->descricao}}</td>
                                <td>{{$competition->category}}</td>
                                <td>{{$competition->player_number}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endrole
        </div>
    </div>
</div>
@endsection