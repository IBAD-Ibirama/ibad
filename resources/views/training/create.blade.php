@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>{{ __('Cadastrar Treino') }}</span>
                    <a class="btn btn-warning btn-sm" href="/treinos"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="card-body">

                    <form action="{{ route('training.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="trainer_select">Selecione a turma:</label>
                            <select name="team_select"
                                class="form-control{{$errors->has('team_select') ? ' border-danger' : '' }}"
                                id="teamOption">

                                <option value="">
                                </option>

                                @foreach($teams as $team)
                                <option value='{{$team->id}}' {{ old("team_select") == $team->id ? "selected":"" }}>
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
                                    {{ old("trainer_select") == $trainer->id ? "selected":"" }}>
                                    {{$trainer->id}} - {{$trainer->name}}
                                </option>;
                                @endforeach

                            </select>

                            <small class="form-text text-danger">
                                {!! $errors->first('trainer_select')!!}
                            </small>
                        </div>

                        <div class="form-group">
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
                                                {{ old("auxiliary1") == $athlete->id ? "selected":"" }}>
                                                {{$athlete->id}} - {{$athlete->name}}
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
                                                {{ old("auxiliary2") == $athlete->id ? "selected":"" }}>
                                                {{$athlete->id}} - {{$athlete->name}}
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
                                        value="{{old("training_local")}}" name="training_local">
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
                                            {{ old("local_select") == $localsDesc->id ? "selected":"" }}>
                                            {{$localsDesc->description}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label id="titleAuxiliary" class="mt-4 mb-2">Período de Repetição</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_init">Data de início do período:</label>
                                        <input type="date" id='training_init'
                                            class="form-control {{ $errors->has('training_init') ? ' border-danger' : '' }}"
                                            name="training_init" min="{{date('Y-m-d')}}" />
                                        <small class="form-text text-danger">
                                            {!! $errors->first('training_init')!!}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="training_repeat">Data final do período:</label>
                                        <input type="date" id='training_repeat'
                                            class="form-control {{$errors->has('training_repeat') ? ' border-danger' : '' }}"
                                            name="training_repeat" disabled />
                                        <small class="form-text text-danger">
                                            {!! $errors->first('training_repeat')!!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day_select">Dia da semana do treino:</label>
                                        <input id='day_select_view' type="text" name="day_select_pt"
                                            class="form-control" readonly value="{{ old('day_select_view') }}" />
                                        <input id='day_select' name="day_select" type="hidden"
                                            value="{{ old('day_select') }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day_select">Número de Treinos Que Serão Cadastrados:</label>
                                        <input id='num_treino' class="form-control" readonly
                                            value="{{ old('num_treino') }}" />
                                    </div>
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
                                            name="training_init_time" value="{{ old('training_init_time') }}">
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
                                            name="training_end_time" value="{{ old('training_end_time') }}">
                                        <small class="form-text text-danger">
                                            {!! $errors->first('training_end_time')!!}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary mt-4" value="Criar treino(s)">
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
var locals = {!! json_encode($place) !!};
var teams_can_have_auxiliary = {!!json_encode($teams_can_have_auxiliary)!!};
</script>
<script src="{{asset('js/pages/training_create.js')}}"></script>
@endsection
