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
<form id="formulario" action="{{ URL::to('competicao/criar') }}" method="POST">
    @csrf
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
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection

