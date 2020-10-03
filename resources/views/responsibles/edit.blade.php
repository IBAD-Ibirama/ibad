@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Editar responsável</span>
          <a class="btn btn-warning btn-sm" href="/responsaveis"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form action="/responsaveis/{{$responsible->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="user_id">Usuário</label>
              <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                <option value="{{$user->id}}" {{ $responsible->user->id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" name="usuario" id="usuario" value="{{$responsible->user->id}}">
            <div class="form-group">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control{{$errors->has('cpf') ? ' border-danger' : '' }}" id="cpf" name="cpf" value="{{$responsible->cpf ?? old('cpf')}}">
              <small class="form-text text-danger">{!! $errors->first('cpf') !!}</small>
            </div>
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input type="text" class="form-control{{$errors->has('phone') ? ' border-danger' : '' }}" id="phone" name="phone" value="{{$responsible->phone ?? old('phone')}}">
              <small class="form-text text-danger">{!! $errors->first('phone') !!}</small>
            </div>
            <div class="form-group">
              <label for="athletes">Atletas</label>
              <select name="athlete" id="athlete" class="form-control">
                @foreach($athletes as $athlete)
                <option value="{{$athlete->id}}" id="athlete-{{$athlete->id}}" data-name="{{$athlete->user->name}}">{{$athlete->user->name}}</option>
                @endforeach
              </select>
            </div>
            <ul class="form-group" id="listaDeAtletas" style="list-style: none; padding: 0">
              @foreach($responsible->athletes as $athlete)
              <li class='mb-3' id='item{{$athlete->id}}'>
                <div class="input-group">
                    <input type='text' class='form-control' value='{{$athlete->user->name}}' readonly>
                    <div class="input-group-prepend">
                        <button class='btn btn-outline-danger' type='button' onclick='removerAtleta({{$athlete->id}})'>Remover</button>
                    </div>
                </div>
                <input type='hidden' name='{{$athlete->id}}' id='atleta' value='{{$athlete->id}}'>
              </li>
              @endforeach
            </ul>
            <input class="btn btn-primary mt-4" type="submit" value="Atualizar responsável">
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

@section('script')
<script src="{{ asset('js/pages/responsibles.js') }}"></script>
@endsection
