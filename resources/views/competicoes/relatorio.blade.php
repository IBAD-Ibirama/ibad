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
<form action="{{ URL::to('competicoes/relatorio') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="idCampeonato">Id do campeonato para o Relatório</label>
        <input type="text" class="form-control" id="idCampeonato" name="id" placeholder="Id do Campeonato">
        <small class="form-text text-muted">Informe o id do campeonato para emissão.</small>
    </div>
    <div class="form-group">
        <label for="descricaoCampeonato">Descrição do Campeonato</label>
        <textarea class="form-control" id="descricaoCampeonato" name="descricao" placeholder="Texto do Relatório"></textarea>
        <small class="form-text text-muted">Informe o texto de descrição para ser inserido no relatório.</small>
    </div>
    <button type="submit" class="btn btn-primary">Emitir</button>
</form>
@endsection