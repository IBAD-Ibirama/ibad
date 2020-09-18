@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar novo responsável</span>
          <a class="btn btn-warning btn-sm" href="/responsaveis"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form autocomplete="off" action="/responsaveis" method="post">
            @csrf
            <div class="form-group">
              <label for="user_id">Usuário</label>
              <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                <option value="{{$user->id}}" onclick="atualizarUsuario(this.value)">{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" name="usuario" id="usuario" value="">
            <div class="form-group">
              <label for="cpf">Cpf</label>
              <input type="text" class="form-control{{$errors->has('cpf') ? ' border-danger' : '' }}" id="cpf" name="cpf" value="{{old('cpf')}}">
              <small class="form-text text-danger">{!! $errors->first('cpf') !!}</small>
            </div>
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input type="text" class="form-control{{$errors->has('phone') ? ' border-danger' : '' }}" id="phone" name="phone" value="{{old('phone')}}">
              <small class="form-text text-danger">{!! $errors->first('phone') !!}</small>
            </div>
            <div class="form-group">
              <label for="athletes">Atletas</label>
              <select name="athlete" id="athlete" class="form-control">
                @foreach($athletes as $athlete)
                <option value="{{$athlete->id}}" id="{{$athlete->user->name}}" onclick="adicionarNovoAtleta(this.value,this.id)">{{$athlete->user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group" id="listaDeAtletas">
              
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar responsável">
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
