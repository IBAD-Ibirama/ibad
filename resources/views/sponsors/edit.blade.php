@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('financeiro')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Editar patrocinador</span>
          <a class="btn btn-warning btn-sm" href="/patrocinadores"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>

        <div class="card-body">
          <form action="/patrocinadores/{{ $sponsors->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="cnpj">CNPJ</label>
              <input type="text" class="form-control{{ $errors->has('cnpj') ? ' border-danger' : '' }}" id="cnpj" name="cnpj" value="{{ $sponsors->cnpj ?? old('cnpj') }}">
              <small class="form-text text-danger">{ !! $errors->first('cnpj') !!}</small>
            </div>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control{{ $errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="{{ $sponsors->name ?? old('name') }}">
              <small class="form-text text-danger">{ !! $errors->first('name') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{ $errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{ $sponsors->email ?? old('email') }}">
              <small class="form-text text-danger">{ !! $errors->first('email') !! }</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Atualizar patrocinador">
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