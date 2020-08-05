@extends('base')
 
@section('content')
<form>
  <div class="form-group">
    <label for="nomeCampeonato">Campeonato para o Relatório</label>
    <input type="text" class="form-control" id="nomeCampeonato" placeholder="Nome do Campeonato">
    <small class="form-text text-muted">Informe o nome do campeonato para consulta.</small>
  </div>
  <div class="form-group">
    <label for="descricaoCampeonato">Descrição do Campeonato</label>
    <input type="memo" class="form-control" id="descricaoCampeonato" placeholder="Texto do Relatório">
    <small class="form-text text-muted">Informe o texto de descrição para ser inserido no relatório.</small>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
@endsection