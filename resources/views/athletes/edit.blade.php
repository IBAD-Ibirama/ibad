@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar novo atleta</span>
          <a class="btn btn-warning btn-sm" href="/atletas"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form autocomplete="off" action="/atletas/{{$athlete->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="user">Usuário</label>
            <select name="usuario" id="usuario" class="form-control">
              @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="dataNasc">Data de Nascimento</label>
              <input type="date" class="form-control{{$errors->has('dataNasc') ? ' border-danger' : '' }}" id="dataNasc" name="dataNasc" value="{{$athlete->dataNasc ?? old('dataNasc')}}">
              <small class="form-text text-danger">{!! $errors->first('dataNasc') !!}</small>
            </div>
            <div class="form-group">
              <label for="sexo">Sexo</label>
              <select name="sexo" id="sexo" class="form-control">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="O">Outros</option>
              </select>
            </div>
            <div class="form-group">
              <label for="rg">Rg</label>
              <input type="text" class="form-control{{$errors->has('rg') ? ' border-danger' : '' }}" id="rg" name="rg" value="{{$athlete->rg ?? old('rg')}}">
              <small class="form-text text-danger">{!! $errors->first('rg') !!}</small>
            </div>
            <div class="form-group">
              <label for="fone">Fone</label>
              <input type="text" class="form-control{{$errors->has('fone') ? ' border-danger' : '' }}" id="fone" name="fone" value="{{$athlete->fone ?? old('fone')}}">
              <small class="form-text text-danger">{!! $errors->first('fone') !!}</small>
            </div>
            <div class="form-group">
              <label for="periodo">Periodo</label>
              <select name="periodo" id="periodo" class="form-control">
                <option value="M">Matutino</option>
                <option value="V">Vespertino</option>
                <option value="N">Noturno</option>
              </select>
            </div>
            <div class="form-group">
              <label for="serie">Serie</label>
              <input type="text" class="form-control{{$errors->has('serie') ? ' border-danger' : '' }}" id="serie" name="serie" value="{{$athlete->serie ?? old('serie')}}">
              <small class="form-text text-danger">{!! $errors->first('serie') !!}</small>
            </div>
            <div class="form-group">
              <label for="problemaSaude">Problema de saude</label>
              <input type="text" class="form-control{{$errors->has('problemaSaude') ? ' border-danger' : '' }}" id="problemaSaude" name="problemaSaude" value="{{$athlete->problemaSaude ?? old('problemaSaude')}}">
              <small class="form-text text-danger">{!! $errors->first('problemaSaude') !!}</small>
            </div>
            <div class="form-group">
              <label for="medicacao">Medicacao</label>
              <input type="text" class="form-control{{$errors->has('medicacao') ? ' border-danger' : '' }}" id="medicacao" name="medicacao" value="{{$athlete->medicacao ?? old('medicacao')}}">
              <small class="form-text text-danger">{!! $errors->first('medicacao') !!}</small>
            </div>
            <div class="form-group">
              <label for="tamanhoUniforme">Tamanho uniforme</label>
              <select name="tamanhoUniforme" id="tamanhoUniforme" class="form-control">
                <option value="PP">PP</option>
                <option value="P">P</option>
                <option value="M">M</option>
                <option value="G">G</option>
                <option value="GG">GG</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tipoSangue">Tipo Sanguineo</label>
              <select name="tipoSangue" id="tipoSangue" class="form-control">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O">O</option>
                <option value="O-">O-</option>
              </select>
            </div>
            @if(file_exists('images/athletes/'. $athlete->id . '_large.jpg'))
            <div class="mb-2">             
              <img style="max-width: 400px; max-height: 300px;" src="/images/athletes/{{$athlete->id}}_large.jpg" alt="">                              
              <a class="btn btn-outline-danger float-right" href="/delete-images/athlete/{{$athlete->id}}">Delete image</a>
            </div>
            @endif
            <div class="form-group">
              <label for="imagem">Foto</label>
              <input type="file" class="form-control{{$errors->has('imagem') ? ' border-danger' : '' }}" id="imagem" name="imagem" value="{{$athlete->imagem ?? old('imagem')}}">
              <small class="form-text text-danger">{!! $errors->first('imagem') !!}</small>
            </div>
            <div class="form-group">
              <label for="escola">Escola</label>
              <input type="text" class="form-control{{$errors->has('escola') ? ' border-danger' : '' }}" id="escola" name="escola" value="{{$athlete->escola ?? old('escola')}}">
              <small class="form-text text-danger">{!! $errors->first('escola') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Atualizar atleta">
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
