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
<script>
    loadData();

    function loadData() {
        const data = <?= $competicao ?>;
        if(data == null){
            return;
        }
        function formatDate(date) {
            var data  = new Date(date);
            var month = '' + (data.getMonth() + 1);
            var day   = '' + (data.getDate() + 1);
            var year  = data.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }
        data.date = formatDate(data.date);
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
   
