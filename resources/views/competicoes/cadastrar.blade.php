@extends('base')
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
        <label for="data">Data</label>
        <input type="text" class="form-control" id="data" name="data" placeholder="00/00/0000">
        <small class="form-text text-muted">Data da realização da competição</small>
    </div>
    <div class="form-group">
        <label for="coordenador">Coordenador</label>
        <input type="text" class="form-control" id="coordenador" name="coordenador" placeholder="Fulano da silva">
        <small class="form-text text-muted">Nome do coordenador da competição</small>
    </div>
    <div class="form-group">
        <label for="nivelCompeticao">Nivel da Competicao</label>
        <input type="text" class="form-control" id="nivelCompeticao" name="nivelCompeticao" placeholder="Médio">
        <small class="form-text text-muted">Médio, Altao, Baixo</small>
    </div>
    <div class="form-group">
        <label for="local">Local</label>
        <textarea class="form-control" id="local" name="local" placeholder="Texto do Relatório"></textarea>
        <small class="form-text text-muted">Informe o local onde foi realizada a competição</small>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection