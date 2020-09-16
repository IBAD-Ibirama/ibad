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
                    <span>Criar nova competição</span>
                    <a class="btn btn-warning btn-sm" href="/competicao"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="card-body">
                    <form id="formulario" action="{{ URL::to('competicao/criar') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="00/00/0000" required>
                            <small class="form-text text-muted">Data da realização da competição</small>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" placeholder="Informe a Descrição" required></textarea>
                            <small class="form-text text-muted">Informe a descrição da competição</small>
                        </div>
                        <div class="form-group">
                            <label for="competition_level">Nivel da Competicao</label>
                            <select name="competition_level" id="competition_level" required>
                                <option value="1">Alto</option>
                                <option value="2">Médio</option>
                                <option value="3">Baixo</option>
                            </select>
                            <small class="form-text text-muted">Médio, Alto, Baixo</small>
                        </div>
                        <div class="form-group">
                            <label for="place">Local</label>
                            <textarea class="form-control" id="place" name="place" placeholder="Texto do Relatório" required></textarea>
                            <small class="form-text text-muted">Informe o local onde foi realizada a competição</small>
                        </div>

                        <input class="btn btn-primary mt-4" type="submit" value="Criar competição">
                    </form>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endrole
        </div>
    </div>
</div>
@endsection