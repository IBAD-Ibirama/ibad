@extends('layouts.app')

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
                <th scope="col">Situação</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frequencys as $frequency)
                <td> {{ ($frequency->presence)? 'PRESENTE': 'AUSENTE' }}</td>
                <td> {{  date('d/m/Y', strtotime($frequency->date)) }}</td>
            @endforeach
        </tbody>
    </table>
</div>

@endsection