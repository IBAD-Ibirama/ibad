@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Criar um patrocinador</div>
        <div class="card-body">
          <form action="/sponsors" method="post">
            @csrf
            <div class="form-group">
              <label for="cnpj">CNPJ</label>
              <input type="text" class="form-control{{$errors->has('name') ? ' border-danger' : '' }}" id="cnpj" name="cnpj" value="{{old('cnpj')}}">
              <small class="form-text text-danger">{!! $errors->first('cnpj') !!}</small>
            </div>
            <div class="form-group">
              <label for="value">Nome</label>
              <input type="value" class="form-control{{$errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="">
              <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{old('email')}}">
              <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar registro">
          </form>
          <a class="btn btn-primary float-right" href="/sponsors"><i class="fas fa-arrow-circle-up"></i> Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection