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
          <form autocomplete="off" action="/atletas" method="post" enctype="multipart/form-data">
            @csrf
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
              <input type="date" class="form-control{{$errors->has('birthdate') ? ' border-danger' : '' }}" id="birthdate" name="birthdate" value="{{old('birthdate')}}">
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
              <input type="text" class="form-control{{$errors->has('rg') ? ' border-danger' : '' }}" id="rg" name="rg" value="">
              <small class="form-text text-danger">{!! $errors->first('rg') !!}</small>
            </div>
            <div class="form-group">
              <label for="telephone">Telefone</label>
              <input type="text" class="form-control{{$errors->has('telephone') ? ' border-danger' : '' }}" id="telephone" name="telephone" value="">
              <small class="form-text text-danger">{!! $errors->first('telephone') !!}</small>
            </div>
            <div class="form-group">
              <label for="shift">Período</label>
              <select name="shift" id="shift" class="form-control">
                <option value="M">Matutino</option>
                <option value="V">Vespertino</option>
                <option value="N">Noturno</option>
              </select>
            </div>
            <div class="form-group">
              <label for="grade">Série</label>
              <input type="text" class="form-control{{$errors->has('grade') ? ' border-danger' : '' }}" id="grade" name="grade" value="">
              <small class="form-text text-danger">{!! $errors->first('grade') !!}</small>
            </div>
            <div class="form-group">
              <label for="health_problem">Problema de Saúde</label>
              <input type="text" class="form-control{{$errors->has('health_problem') ? ' border-danger' : '' }}" id="health_problem" name="health_problem" value="">
              <small class="form-text text-danger">{!! $errors->first('health_problem') !!}</small>
            </div>
            <div class="form-group">
              <label for="medication">Medicação</label>
              <input type="text" class="form-control{{$errors->has('medication') ? ' border-danger' : '' }}" id="medication" name="medication" value="">
              <small class="form-text text-danger">{!! $errors->first('medication') !!}</small>
            </div>
            <div class="form-group">
              <label for="cloth_size">Tamanho do Uniforme</label>
              <select name="cloth_size" id="cloth_size" class="form-control">
                <option value="PP">PP</option>
                <option value="P">P</option>
                <option value="M">M</option>
                <option value="G">G</option>
                <option value="GG">GG</option>
              </select>
            </div>
            <div class="form-group">
              <label for="blood_type">Tipo Sanguíneo</label>
              <select name="blood_type" id="blood_type" class="form-control">
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
            <div class="form-group">
              <label for="imagem">Foto</label>
              <input type="file" class="form-control{{$errors->has('imagem') ? ' border-danger' : '' }}" id="imagem" name="imagem" value="">
              <small class="form-text text-danger">{!! $errors->first('imagem') !!}</small>
            </div>
            <div class="form-group">
              <label for="school">Escola</label>
              <input type="text" class="form-control{{$errors->has('school') ? ' border-danger' : '' }}" id="school" name="school" value="">
              <small class="form-text text-danger">{!! $errors->first('school') !!}</small>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar atleta">
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
<script>
  $(document).ready(function() {
    $('#telephone').mask('(00)00000-0000');
    $('#rg').mask('0.000.000');
  });
</script>
@endsection
