@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Editar patrocinador</div>
        <div class="card-body">
          <form action="/sponsors/{{$sponsors->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="cnpj">CNPJ</label>
              <input type="text" class="form-control{{$errors->has('cnpj') ? ' border-danger' : '' }}" id="cnpj" name="cnpj" value="{{$sponsors->cnpj ?? old('cnpj')}}">
              <small class="form-text text-danger">{!! $errors->first('cnpj') !!}</small>
            </div>
            <div class="form-group">
              <label for="newname">Nome</label>
              <input type="text" class="form-control{{$errors->has('newname') ? ' border-danger' : '' }}" id="newname" name="newname" value="{{$sponsors->name ?? old('name')}}">
              <small class="form-text text-danger">{!! $errors->first('newname') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{$sponsors->email ?? old('email')}}">
              <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Update Sponsor">
          </form>
          <a class="btn btn-primary float-right" href="/sponsors"><i class="fas fa-arrow-circle-up"></i> Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection