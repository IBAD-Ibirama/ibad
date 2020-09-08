@extends('base')

@section('content')
<style>
    table{
        text-align: center;
    }
</style>
<div class="container">
    <h1>Frequência</h1>
    <table id="tabela" class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome do Atleta</th>
                <th scope="col">Número de faltas</th>
                <th scope="col">Número total de treinos</th>
                <th scope="col">Frequência em porcentagem</th>
            </tr>
        </thead>
        <tbody>
            <td> {{ $frequency->nameAthlete }}</td>
            <td> {{ $frequency->numberOfLack }}</td>
            <td> {{ $frequency->numberOfTraining }}</td>
            <td> {{ $frequency->freqPor }}</td>
        </tbody>
    </table>
</div>

@endsection