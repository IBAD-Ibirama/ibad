@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Financeiro</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Valor</th>
                <th scope="col">Data</th>
                <th scope="col">Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finances as $finance)
            <tr>
                <td>{{strtoupper($finance->type)}}</td>
                <td>{{number_format($finance->value, 2, "," , ".")}}</td>
                <td>{{date('d/m/Y', strtotime($finance->date))}}</td>
                <td>{{$finance->description}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection