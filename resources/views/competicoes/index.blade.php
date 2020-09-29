<?php

use Illuminate\Support\Facades\URL;
?>

@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ooops!</strong> Houve um problema com sua requisição...<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('admin')
            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Consulta de competições</span>
                    <a class='btn btn-success btn-sm' href="/competicao/cadastrar">Registrar competição</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Local</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Nível Competição</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($competitions as $competition)
                            <tr>
                                <td>{{$competition->id}}</td>
                                <td>{{$competition->date}}</td>
                                <td>{{$competition->place}}</td>
                                <td>{{$competition->description}}</td>
                                <td>{{$competition->competition_level}}</td>
                                <td>
                                    <div class="float-right flex">
                                        <a class="btn btn-sm btn-light mr-2" href="/competicao/alterar/{{$competition->id}}">Editar</a>

                                        <form style="display: inline" action="/competicao/remove/{{$competition->id}}" method="delete">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Deletar">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else

        <p>Você não tem permissão para acessar essa funcionalidade.</p>

        @endrole
    </div>
</div>
@endsection