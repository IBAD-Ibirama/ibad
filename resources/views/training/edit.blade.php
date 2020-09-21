@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Editar Treino') }}</span>
                    <a class="btn btn-warning btn-sm" href="/treinos"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="mt-5 mb-3">
                  <form action="{{ route('training.update', $training->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="team_id" value="{{$training->id}}">
                  <div class="col-md-6">
                    <label for="trainer_select">Selecione a turma:</label>
                      <div class="form-group">
                        <select name="team_select" class="form-control" id="teamOption">
                          <option value=" {{$training->team->id}} - {{$training->team->name}}">{{$training->team->id}} - {{$training->team->name}}
                          </option>
                          @foreach($teams as $team)
                            <option value='{{$team->id}}'>
                              {{$team->id}} - {{$team->name}}
                            </option>;
                            @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <label for="trainer_select">Selecione o treinador:</label>
                      <div class="form-group">
                        <select name="trainer_select" class="form-control" id="trainerOption">
                          <option value="">
                          </option>
                      
                        </select>
                      </div>
                  </div>     
                  <div class="col-md-10">
                    <label for="level" id="titleAuxiliary">Ajudantes:</label>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <select id="auxiliary1" class="form-control" name="auxiliary1">
                            <option>
                            </option>
                            @foreach($athletes as $athlete)
                            <option value='{{$athlete->id}}'>
                              {{$athlete->id}} - {{$athlete->name}}
                            </option>;
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <select id="auxiliary2" class="form-control" name="auxiliary2">
                            <option>
                            </option>
                            @foreach($athletes as $athlete)
                              <option value='{{$athlete->id}}'>
                              {{$athlete->id}} - {{$athlete->name}}
                              </option>;
                            @endforeach
                            </select>
                        </div>
                      </div> 
                      </div>
                  </div>
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="training_local">Novo local de treino:</label>
                          <input id='training_local' class="form-control" name="training_local">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="local_select">Locais de treino existentes:</label>
                          <select name="local_select" class="form-control" id="localOption">
                            <option value="{{ $training->local->description }}">{{ $training->local->description }}
                            </option>
                            @foreach ($place as $localsDesc)
                            <option value={{$localsDesc->id}}>
                              {{$localsDesc->description}}
                            </option>
                            @endforeach
                          </select>
                        </div>    
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="day_select">Dia da semana:</label>
                    <div class="form-group">
                      <select name="day_select" class="form-control" id="day_select">
                      <option value="{{ $training->week_day }} ">{{ $training->week_day }}</option>
                        <option value="segunda">Segunda-Feira</option>
                        <option value="terca">Terça-Feira</option>
                        <option value="quarta">Quarta-Feira</option>
                        <option value="quinta">Quinta-Feira</option>
                        <option value="sexta">Sexta-Feira</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="training_init_time">Horário de início (hh:mm):</label>
                          <input id='inputTimeInit' class="form-control" name="training_init_time" value="{{ $training->time_init}} ">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="training_end_time">Horário de término (hh:mm):</label>
                          <input id='inputTimeEnd' class="form-control" name="training_end_time" value="{{ $training->time_end}}">
                        </div>
                      </div>
                </div>
              </div>
            </div>

        <div class="col-md-10">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="training_init">Data inicial: (dd/mm/aaaa):</label>
                <input id='training_init' class="form-control" name="training_init" value="{{ (new DateTime(substr($training->date,0,10)))->format('d/m/Y')}} ">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="training_repeat">Data final: (dd/mm/aaaa):</label>
                <input id='inputRepeat' class="form-control" name="training_repeat">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mt-5 mb-2 col-12 col-md-3">
                <input type="submit" class="btn btn-success btn-lg btn-sm-block"
                        value="Atualizar treino">
            </div>
          </div>
    </form>
  </div>
  @else

  <p>Você não tem permissão para acessar essa funcionalidade.</p>

  @endcan
      
</div>
<script>
  const inputLocal = document.querySelector('#training_local');
  const optionLocal = document.querySelector('#localOption');
  const auxiliary1 = document.querySelector('#auxiliary1');
  const auxiliary2 =document.querySelector('#auxiliary2');
  const auxiliaryTitle =document.querySelector('#titleAuxiliary');
  const team = document.querySelector('#teamOption');
  const locals = {!! json_encode($place) !!};
  
  const teams_can_have_auxiliary = {!!json_encode($teams_can_have_auxiliary)!!};


  inputLocal.onchange = () => cleanSelectOption();
  
  function cleanSelectOption() {
      optionLocal.selectedIndex = "0";
  }
  
  
  function handleAuxiliaries(id){
    let can_have_aux = false;
  teams_can_have_auxiliary.forEach(element => {
    if (id == element.id){
        can_have_aux = true;
    }
  });

  if(!can_have_aux){
    auxiliary1.disabled =true;
    auxiliary1.value = null;
    auxiliary2.disabled =true;
    auxiliary2.value= null;
    auxiliaryTitle.textContent = "Essa turma não pode ter ajudantes!";
  }else{
    auxiliary1.disabled =false;
    auxiliary2.disabled =false;
    auxiliaryTitle.textContent = "Ajudantes:";
  }
  }
 
  team.onchange = () => {
    handleAuxiliaries(team.value);
  }

  optionLocal.onchange = () => {
      if(!optionLocal.value) {
          return;
      }
      const [local] = locals.filter((local) => local.id == optionLocal.value);
      inputLocal.value = local.description;
  }

</script>


@endsection