@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Editar movimentação</span>
          <a class="btn btn-warning btn-sm" href="/movimentacoes"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>

        <div class="card-body">
          <form action="/movimentacoes/{{$moves->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <input type="text" class="form-control{{$errors->has('descricao') ? ' border-danger' : '' }}" id="descricao" name="descricao" value="{{$moves->descricao ?? old('descricao')}}">
              <small class="form-text text-danger">{!! $errors->first('descricao') !!}</small>
            </div>
            <div class="form-group">
              <label for="data">Data</label>
              <input type="date" class="form-control{{$errors->has('data') ? ' border-danger' : '' }}" id="data" name="data" value="{{$moves->data ?? old('data')}}">
              <small class="form-text text-danger">{!! $errors->first('data') !!}</small>
            </div>
            <div class="form-group">
              <label for="valor">Valor</label>
              <input type="text" class="form-control{{$errors->has('valor') ? ' border-danger' : '' }}" id="valor" name="valor" value="{{$moves->valor ?? old('valor')}}">
              <small class="form-text text-danger">{!! $errors->first('valor') !!}</small>
            </div>
            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select name="tipo" id="tipo" class="form-control">
                <option value="entrada" selected>Entrada</option>
                <option value="saida">Saída</option>
              </select>
            </div>
            <div class="form-group">
              <label for="especificacao">Especificação</label>
              <input type="text" class="form-control{{$errors->has('especificacao') ? ' border-danger' : '' }}" id="especificacao" name="especificacao" value="{{$moves->especificacao ?? old('especificacao')}}">
              <small class="form-text text-danger">{!! $errors->first('especificacao') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Atualizar movimentação">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
