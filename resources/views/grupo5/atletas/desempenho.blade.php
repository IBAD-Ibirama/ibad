@extends('base')

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

<div class="divParticipacoes">
    <h4>Descrição do Desempenho do Atleta</h4>
    <div class="bodyGridParticipacoes">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Local</th>
                    <th scope="col">Resultado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participacoesAtleta as $participacao)
                <tr>
                    <td>{{$participacao->data}}</td>
                    <td>{{$participacao->local}}</td>
                    <td>{{$participacao->resultado}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection