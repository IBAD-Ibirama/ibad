@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('financeiro')
      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar nova movimentação</span>
          <a class="btn btn-warning btn-sm" href="/movimentacoes"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form action="/movimentacoes" method="post">
            @csrf
            <div class="form-group">
              <label for="description">Descrição</label>
              <input type="text" class="form-control{{$errors->has('description') ? ' border-danger' : '' }}" id="description" name="description" value="{{old('description')}}">
              <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
            </div>
            <div class="form-group">
              <label for="date">Data</label>
              <input type="date" class="form-control{{$errors->has('date') ? ' border-danger' : '' }}" id="date" name="date" value="{{old('date')}}">
              <small class="form-text text-danger">{!! $errors->first('date') !!}</small>
            </div>
            <div class="form-group">
              <label for="value">Valor</label>
              <input type="text" class="form-control{{$errors->has('value') ? ' border-danger' : '' }}" id="value" name="value" value="">
              <small class="form-text text-danger">{!! $errors->first('value') !!}</small>
            </div>
            <div class="form-group">
              <label for="type">Tipo</label>
              <select name="type" id="type" class="form-control">
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
              </select>
            </div>
            <div class="form-group">
              <label for="specification">Especificação</label>
              <input type="text" class="form-control{{$errors->has('specification') ? ' border-danger' : '' }}" id="specification" name="specification" value="">
              <small class="form-text text-danger">{!! $errors->first('specification') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar movimentação">
          </form>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection
