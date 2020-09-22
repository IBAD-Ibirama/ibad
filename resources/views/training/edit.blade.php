@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Editar Treino') }}</span>
                    <a class="btn btn-warning btn-sm" href="/treinos"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="card-body">

                    <form action="{{ route('training.update', $training->id ) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="trainer_select">Selecione a turma:</label>
                            <select name="team_select"
                                class="form-control{{$errors->has('team_select') ? ' border-danger' : '' }}"
                                id="teamOption">

                                <option value="">
                                </option>

                                @foreach($teams as $team)
                                <option value='{{$team->id}}' {{ $training->team->id == $team->id ? "selected" : ''}}
                                    {{ old("team_select") == $team->id ? "selected":"" }}>
                                    {{$team->id}} - {{$team->name}}
                                </option>;
                                @endforeach

                            </select>

                            <small class="form-text text-danger">
                                {!! $errors->first('team_select')!!}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="trainer_select">Selecione o treinador:</label>
                            <select name="trainer_select"
                                class="form-control {{$errors->has('trainer_select') ? ' border-danger' : '' }}"
                                id="trainerOption">

                                <option value="">
                                </option>

                                @foreach($trainers as $trainer)
                                <option value='{{$trainer->id}}'
                                    {{ $training->trainer->id == $trainer->id ? "selected" : ''}}
                                    {{ old("trainer_select") == $trainer->id ? "selected":"" }}>
                                    {{$trainer->id}} - {{$trainer->name}}
                                </option>;
                                @endforeach

                            </select>

                            <small class="form-text text-danger">
                                {!! $errors->first('trainer_select')!!}
                            </small>
                        </div>

                        <div class=" form-group">
                            <label id="titleAuxiliary" class="mt-4 mb-2">Ajudantes</label>
                            <div class="row" id='form-auxiliarys'>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="auxiliary1">Auxiliar 1:</label>

                                        <select id="auxiliary1"
                                            class="form-control {{$errors->has('auxiliary1') ? ' border-danger' : '' }}"
                                            name="auxiliary1">

                                            <option>
                                            </option>

                                            @foreach($athletes as $athlete)
                                            <option value='{{$athlete->id}}'
                                                {{ count($helpers) != 0 ? ($helpers[0]->athlete->id == $athlete->id ? "selected":"") : '' }}
                                                {{ old("auxiliary1") == $athlete->id ? "selected":"" }}>
                                                {{ $athlete->id }} - {{ $athlete->name }}
                                            </option>;
                                            @endforeach

                                        </select>
                                        <small class="form-text text-danger">
                                            {!! $errors->first('auxiliary1')!!}
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="auxiliary2">Auxiliar 2:</label>
                                        <select id="auxiliary2"
                                            class="form-control {{$errors->has('auxiliary2') ? ' border-danger' : '' }}"
                                            name="auxiliary2">

                                            <option>
                                            </option>

                                            @foreach($athletes as $athlete)
                                            <option value='{{$athlete->id}}'
                                                {{ count($helpers) != 0 ? ($helpers[1]->athlete->id == $athlete->id ? "selected":"") : ""}}
                                                {{ old("auxiliary2") == $athlete->id ? "selected":"" }}>
                                                {{ $athlete->id }} - {{ $athlete->name }}
                                            </option>;
                                            @endforeach

                                        </select>

                                        <small class="form-text text-danger">
                                            {!! $errors->first('auxiliary2')!!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="training_local">Nome do local de treino:</label>
                                    <input id='training_local'
                                        class="form-control {{$errors->has('training_local') ? ' border-danger' : '' }}"
                                        value="{{old("training_local") ? old("training_local") : $training->local->description }}"
                                        name="training_local">
                                    <small class="form-text text-danger">
                                        {!! $errors->first('training_local')!!}
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="local_select">Locais de treino existentes:</label>
                                    <select name="local_select" class="form-control" id="localOption">
                                        <option value="">
                                        </option>
                                        @foreach ($place as $localsDesc)
                                        <option value={{$localsDesc->id}}
                                            {{ $training->local->id == $localsDesc->id ? "selected":"" }}
                                            {{ old("local_select") == $localsDesc->id ? "selected":"" }}>
                                            {{$localsDesc->description}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="training_init">Data:</label>
                                    <input type="date" id='training_init'
                                        value="{{ (new DateTime(substr($training->date,0,10)))->format('Y-m-d')}}"
                                        class="form-control {{ $errors->has('training_init') ? ' border-danger' : '' }}"
                                        name="training_init" min="{{date('Y-m-d')}}" />
                                    <small class="form-text text-danger">
                                        {!! $errors->first('training_init')!!}
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="day_select">Dia da semana do treino:</label>
                                    <input id='day_select_view' type="text" name="day_select_pt" class="form-control"
                                        readonly value="{{ $training->week_day }}" />
                                    <input id='day_select' name="day_select" type="hidden" value="" />
                                </div>
                            </div>

                        </div>


                        <div>
                            <label id="titleAuxiliary" class="mt-4 mb-2">Horário do Treino</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_init_time">Horário de início (hh:mm):</label>
                                        <input type="time" id='inputTimeInit'
                                            class="form-control {{$errors->has('training_init_time') ? ' border-danger' : '' }}"
                                            name="training_init_time"
                                            value="{{ old('training_init_time') ? old('training_init_time') : $training->time_init }}">
                                        <small class="form-text text-danger">
                                            {!! $errors->first('training_init_time')!!}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_end_time">Horário de término (hh:mm):</label>
                                        <input type="time" id='inputTimeEnd'
                                            class="form-control {{$errors->has('training_end_time') ? ' border-danger' : '' }}"
                                            name="training_end_time"
                                            value="{{ old('training_end_time') ? old('training_end_time') : $training->time_end }}">
                                        <small class="form-text text-danger">
                                            {!! $errors->first('training_end_time')!!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary mt-4" value="Atualizar treino">
                    </form>
                </div>

            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endcan
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    const inputLocal = document.querySelector('#training_local');
  const optionLocal = document.querySelector('#localOption');
  const locals = {!! json_encode($place) !!};

  const auxiliaryForm = document.querySelector('#form-auxiliarys');
  const auxiliaryTitle = document.querySelector('#titleAuxiliary');
  const team = document.querySelector('#teamOption');
  const teams_can_have_auxiliary = {!!json_encode($teams_can_have_auxiliary)!!};
  const auxiliary1 = document.querySelector('#auxiliary1');
  const auxiliary2 =document.querySelector('#auxiliary2');

  const initPeriodo = document.querySelector('#training_init');
  const diaDaSemana = document.querySelector('#day_select');
  const diaDaSemanaView = document.querySelector('#day_select_view');
  const numTreino = document.querySelector("#num_treino");

  inputLocal.onchange = () => {
      optionLocal.selectedIndex = "0";
  }

  initPeriodo.onchange = setDay;

  function setDay() {
      try {
        const [year, month, day] = initPeriodo.value.split('-');
        const date = new Date(year, month-1, day);
        const day2 = getDay(date.getDay());
        diaDaSemanaView.value = day2[0];
        diaDaSemana.value = day2[1];
      } catch (error) {
          console.log(error);
      }
  }

setDay();

  function getDay(index){
      switch (index){
        case 1:
            return ['Segunda-Feira', 'mo']
        case 2:
            return ['Terça-Feira', 'tu']
        case 3:
            return ['Quarta-Feira', 'we']
        case 4:
            return ['Quinta-Feira', 'th']
        case 5:
            return ['Sexta-Feira', 'fr']
        case 6:
            return ['Sabado', 'sa']
        case 0:
            return ['Domingo', 'su']
      }
  }

  function handleAuxiliaries(id){
    if(!id){
        auxiliaryForm.classList.remove('hide');
        auxiliaryTitle.textContent = "Ajudantes:";
        return;
    }
    const [teamNeedAuxiliary] =   teams_can_have_auxiliary.filter(team => team.id == id);
    if(!teamNeedAuxiliary){
        auxiliary1.value= null;
        auxiliary2.value= null;
        auxiliaryTitle.textContent = "Essa turma não necessita de ter ajudantes!";
        auxiliaryForm.classList.add('hide');
    } else {
        auxiliaryForm.classList.remove('hide');
        auxiliaryTitle.textContent = "Ajudantes:";
    }
  }

  team.onchange = () => {
    handleAuxiliaries(team.value);
  }

  handleAuxiliaries(team.value);
  optionLocal.onchange = () => {
      if(!optionLocal.value) {
          return;
      }
      const [local] = locals.filter((local) => local.id == optionLocal.value);
      inputLocal.value = local.description;
  }

</script>
@endsection
