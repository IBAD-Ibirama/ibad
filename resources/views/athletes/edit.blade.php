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
              <label for="birthdate">Data de Nascimento</label>
              <input type="date" class="form-control{{$errors->has('birthdate') ? ' border-danger' : '' }}" id="birthdate" name="birthdate" value="{{$athlete->birthdate ?? old('birthdate')}}">
              <small class="form-text text-danger">{!! $errors->first('birthdate') !!}</small>
            </div>
            <div class="form-group">
              <label for="gender">Sexo</label>
              <select name="gender" id="gender" class="form-control">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
                <option value="O">Outros</option>
              </select>
            </div>
            <div class="form-group">
              <label for="rg">RG</label>
              <input type="text" class="form-control{{$errors->has('rg') ? ' border-danger' : '' }}" id="rg" name="rg" value="{{$athlete->rg ?? old('rg')}}">
              <small class="form-text text-danger">{!! $errors->first('rg') !!}</small>
            </div>
            <div class="form-group">
              <label for="telephone">Telefone</label>
              <input type="text" class="form-control{{$errors->has('telephone') ? ' border-danger' : '' }}" id="telephone" name="telephone" value="{{$athlete->telephone ?? old('telephone')}}">
              <small class="form-text text-danger">{!! $errors->first('telephone') !!}</small>
            </div>
            <div class="form-group">
              <label for="shift">Período</label>
              <select name="shift" id="shift" class="form-control">
                <option value="M" {{ $athlete->shift == 'M' ? 'selected' : '' }}>Matutino</option>
                <option value="V" {{ $athlete->shift == 'V' ? 'selected' : '' }}>Vespertino</option>
                <option value="N" {{ $athlete->shift == 'N' ? 'selected' : '' }}>Noturno</option>
              </select>
            </div>
            <div class="form-group">
              <label for="grade">Série</label>
              <input type="text" class="form-control{{$errors->has('grade') ? ' border-danger' : '' }}" id="grade" name="grade" value="{{$athlete->grade ?? old('grade')}}">
              <small class="form-text text-danger">{!! $errors->first('grade') !!}</small>
            </div>
            <div class="form-group">
              <label for="health_problem">Problema de Saúde</label>
              <input type="text" class="form-control{{$errors->has('health_problem') ? ' border-danger' : '' }}" id="health_problem" name="health_problem" value="{{$athlete->health_problem ?? old('health_problem')}}">
              <small class="form-text text-danger">{!! $errors->first('health_problem') !!}</small>
            </div>
            <div class="form-group">
              <label for="medication">Medicação</label>
              <input type="text" class="form-control{{$errors->has('medication') ? ' border-danger' : '' }}" id="medication" name="medication" value="{{$athlete->medication ?? old('medication')}}">
              <small class="form-text text-danger">{!! $errors->first('medication') !!}</small>
            </div>
            <div class="form-group">
              <label for="cloth_size">Tamanho do Uniforme</label>
              <select name="cloth_size" id="cloth_size" class="form-control">
                <option value="PP" {{ $athlete->cloth_size == 'PP' ? 'selected' : '' }}>PP</option>
                <option value="P" {{ $athlete->cloth_size == 'P' ? 'selected' : '' }}>P</option>
                <option value="M" {{ $athlete->cloth_size == 'M' ? 'selected' : '' }}>M</option>
                <option value="G" {{ $athlete->cloth_size == 'G' ? 'selected' : '' }}>G</option>
                <option value="GG" {{ $athlete->cloth_size == 'GG' ? 'selected' : '' }}>GG</option>
              </select>
            </div>
            <div class="form-group">
              <label for="blood_type">Tipo Sanguíneo</label>
              <select name="blood_type" id="blood_type" class="form-control">
                <option value="A+" {{ $athlete->blood_type === 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ $athlete->blood_type === 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ $athlete->blood_type === 'B+' ? 'selected' : '' }}>B+</option>
                <option value="AB+" {{ $athlete->blood_type === 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ $athlete->blood_type === 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ $athlete->blood_type === 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O" {{ $athlete->blood_type === 'O' ? 'selected' : '' }}>O</option>
                <option value="O-" {{ $athlete->blood_type === 'O-' ? 'selected' : '' }}>O-</option>
              </select>
            </div>
            @if(file_exists('images/athletes/'. $athlete->id . '_large.jpg'))
            <div class="mb-2">
              <img style="max-width: 400px; max-height: 300px;" src="/images/athletes/{{$athlete->id}}_large.jpg" alt="">
              <a class="btn btn-outline-danger float-right" href="/delete-images/athlete/{{$athlete->id}}">Apagar imagem</a>
            </div>
            @endif
            <div class="form-group">
              <label for="imagem">Foto</label>
              <input type="file" class="form-control{{$errors->has('imagem') ? ' border-danger' : '' }}" id="imagem" name="imagem" value="{{$athlete->imagem ?? old('imagem')}}">
              <small class="form-text text-danger">{!! $errors->first('imagem') !!}</small>
            </div>
            <div class="form-group">
              <label for="school">Escola</label>
              <input type="text" class="form-control{{$errors->has('school') ? ' border-danger' : '' }}" id="school" name="school" value="{{$athlete->school ?? old('school')}}">
              <small class="form-text text-danger">{!! $errors->first('school') !!}</small>
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

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" defer></script>
<script>
  $(document).ready(function() {
    $('#telephone').mask('(00)00000-0000');
    $('#rg').mask('0.000.000');
  });
</script>
@endsection
