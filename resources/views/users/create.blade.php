@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar novo usuário</span>
          <a class="btn btn-warning btn-sm" href="/usuarios"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form action="/usuarios" method="post">
            @csrf
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control{{$errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="{{old('name')}}">
              <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{old('email')}}">
              <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control{{$errors->has('password') ? ' border-danger' : '' }}" id="password" name="password" value="">
              <small class="form-text text-danger">{!! $errors->first('password') !!}</small>
            </div>
            <div class="form-group">
              <label for="permission">Permissão</label>
              <select name="permission" id="permission" class="form-control">
                @foreach($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
              </select>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar usuário">
          </form>
        </div>
      </div>

      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole

    </div>
  </div>
</div>
@endsection
