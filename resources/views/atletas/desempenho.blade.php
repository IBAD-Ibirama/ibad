@extends('layouts.app')

@section('content')
<style>
    .divParticipacoes {
        padding-top: 50px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .bodyGridParticipacoes {
        margin-top: 50px;
        overflow-y: auto;
    }
</style>

<div class="container divParticipacoes">
    <h4>Descrição do Desempenho do Atleta</h4>
    <div class="bodyGridParticipacoes">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Local</th>
                    <th scope="col">Resultado</th>
                    <th scope="col">Modalidade</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participacoesAtleta as $participacao)
                <tr>
                    <td>{{date('d/m/Y', strtotime($participacao->date))}}</td>
                    <td>{{$participacao->place}}</td>
                    <td>{{$participacao->results}}</td>
                    <td>{{$participacao->player_number}}</td>
                    <td>{{$participacao->category}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection