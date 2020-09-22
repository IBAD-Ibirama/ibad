@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('atleta')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Consultar dados</span>
          <a class="btn btn-warning btn-sm" href="/dashboard"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
            <div class="form-group">
              <label for="birthdate">Data de Nascimento</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{$athlete->birthdate}}" readonly>
            </div>
            <div class="form-group">
              <label for="gender">Sexo</label>
              <input type="text" class="form-control" id="gender" name="gender" value="{{(($athlete->gender == 'M' ? 'Masculino' : ($athlete->gender == 'F' ? 'Feminino' : 'Outro'))) }}" readonly>
            </div>
            <div class="form-group">
              <label for="rg">RG</label>
              <input type="text" class="form-control" id="rg" name="rg" value="{{$athlete->rg}}" readonly>
            </div>
            <div class="form-group">
              <label for="telephone">Telefone</label>
              <input type="text" class="form-control" id="telephone" name="telephone" value="{{$athlete->telephone}}" readonly>
            </div>
            <div class="form-group">
              <label for="shift">Período</label>
              <input type="text" class="form-control" id="shift" name="shift" value="{{(($athlete->shift == 'M' ? 'Matutino' : ($athlete->shift == 'V' ? 'Vespertino' : 'Noturno'))) }}" readonly>
            </div>
            <div class="form-group">
              <label for="grade">Série</label>
              <input type="text" class="form-control" id="grade" name="grade" value="{{$athlete->grade}}" readonly>
              <small class="form-text text-danger">{!! $errors->first('grade') !!}</small>
            </div>
            <div class="form-group">
              <label for="health_problem">Problema de Saúde</label>
              <input type="text" class="form-control" id="health_problem" name="health_problem" value="{{$athlete->health_problem}}" readonly>
              <small class="form-text text-danger">{!! $errors->first('health_problem') !!}</small>
            </div>
            <div class="form-group">
              <label for="medication">Medicação</label>
              <input type="text" class="form-control" id="medication" name="medication" value="{{$athlete->medication}}" readonly>
              <small class="form-text text-danger">{!! $errors->first('medication') !!}</small>
            </div>
            <div class="form-group">
              <label for="cloth_size">Tamanho do Uniforme</label>
              <input type="text" class="form-control" id="cloth_size" name="cloth_size" value="{{ $athlete->cloth_size }}" readonly>
            </div>
            <div class="form-group">
              <label for="blood_type">Tipo Sanguíneo</label>
              <input type="text" class="form-control" id="blood_type" name="blood_type" value="{{ $athlete->blood_type }}" readonly>
            </div>
            @if(file_exists('images/athletes/'. $athlete->id . '_large.jpg'))
            <div class="mb-2">
              <img style="max-width: 400px; max-height: 300px;" src="/images/athletes/{{$athlete->id}}_large.jpg" alt="">
            </div>
            @endif
            <div class="form-group">
              <label for="school">Escola</label>
              <input type="text" class="form-control" id="school" name="school" value="{{$athlete->school}}" readonly>
              <small class="form-text text-danger">{!! $errors->first('school') !!}</small>
            </div>
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
