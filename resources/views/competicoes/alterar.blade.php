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
<form id="formulario" action="{{ URL::to('competicao/atualizar') }}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id">
    <div class="form-group">
        <label for="date">Data</label>
        <input type="text" class="form-control" id="date" name="date" placeholder="00/00/0000">
        <small class="form-text text-muted">Data da realização da competição</small>
    </div>
    <div class="form-group">
        <label for="coordinator">Coordenador</label>
        <input type="text" class="form-control" id="coordinator" name="coordinator" placeholder="Fulano da silva">
        <small class="form-text text-muted">Nome do coordenador da competição</small>
    </div>
    <div class="form-group">
        <label for="competition_level">Nivel da Competicao</label>
        <input type="text" class="form-control" id="competition_level" name="competition_level" placeholder="Médio">
        <small class="form-text text-muted">Médio, Altao, Baixo</small>
    </div>
    <div class="form-group">
        <label for="place">Local</label>
        <textarea class="form-control" id="place" name="place" placeholder="Texto do Relatório"></textarea>
        <small class="form-text text-muted">Informe o local onde foi realizada a competição</small>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
<script>
    loadData();

    function loadData() {
        const data = <?= $competicao ?>;
        if(data == null){
            return;
        }
        const elements = document.querySelector('#formulario').elements;
        for(let i=0; i<elements.length; i++){
            const element = elements[i];
            if(data[element.id]){
                element.value = data[element.id];
            }
        }
    }
</script>
@endsection
   
