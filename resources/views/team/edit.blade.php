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
                    <span>Editar turma</span>
                    <a class="btn btn-warning btn-sm" href="/turmas"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>

                <div class="card-body">
                    <form action="/turmas/{{$team->id}}" method="post">
                        @csrf
                        @method('PUT')
                      <div class="form-group">
                            <label for="team_name">Nome</label>
                            <input type="text" class="form-control{{$errors->has('team_name') ? ' border-danger' : '' }}" id="team_name" name="team_name">
                            <small class="form-text text-danger">{!! $errors->first('team_name') !!}</small>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label for="level">Nível Da Turma</label>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="teamLevel_name">Nome do Nível:</label>
                                            <input type="text" class="form-control{{ $errors->has('teamLevel_name') ? ' border-danger' : '' }}" id="teamLevel_name" name="teamLevel_name">
                                            <small class="form-text text-danger">{!! $errors->first('teamLevel_name') !!}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nivelOption">Niveis já existentes</label>
                                        <div class="form-group">
                                            <select name="level_select" class="form-control" id="nivelOption">
                                                <option value="">

                                                </option>
                                                <option value="{{$team->teamLevel->id}}">
                                                    {{$team->teamLevel->name}}
                                                </option>
                                                @foreach ($teamLevels as $teamLevel)
                                                <option value={{$teamLevel->id}}>
                                                    {{$teamLevel->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <small id="emailHelp" class="form-text text-muted">
                                    Informe as características dessa turma
                                </small>
                                <div class="form-check">
                                        <input type="checkbox"  class="form-check-input {{$errors->has('requires_auxiliary') ? ' border-danger' : '' }}" id="requires_auxiliary" name="requires_auxiliary">
                                        <small class="form-text text-danger">{!! $errors->first('requires_auxiliary') !!}</small>
                                    <label class="form-check-label" for="auxiliar">
                                        Turma irá requerer auxiliares durantes os Treinos
                                    </label>
                                </div>

                                <div class="form-check">
                                        <input type="checkbox" class="form-check-input {{$errors->has('pode_auxiliar') ? ' border-danger' : '' }}" id="pode_auxiliar" name="pode_auxiliar">
                                        <small class="form-text text-danger">{!! $errors->first('pode_auxiliar') !!}</small>

                                    <label class="form-check-label" for="pode_auxiliar">
                                        Os atletas dessa podem auxiliar outras turma nos Treinos
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mt-5 mb-2 col-12 col-md-3">
                                <input type="submit" class="btn btn-success btn-lg btn-sm-block"
                                    value="Atualizar Turma">
                            </div>
                        </div>
                    </form>
                </div>
                @else

                <p>Você não tem permissão para acessar essa funcionalidade.</p>

                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const nivelsCadastrados =  {!! json_encode($allTeamLevels) !!};
  const inputNome = document.querySelector('#inputName');
  const checkAuxiliar = document.querySelector('#auxiliar');
  const checkPodeAuxiliar = document.querySelector('#pode_auxiliar');
  const optionNivel = document.querySelector('#nivelOption');

  inputNome.onchange = () => cleanSelectOption();
  checkAuxiliar.onclick = () => cleanSelectOption();
  checkPodeAuxiliar.onclick = () => cleanSelectOption();

  function cleanSelectOption() {
    optionNivel.selectedIndex = "0";
  }

  optionNivel.onchange = () => setOptionNivel();

  function setOptionNivel () {
    if(!optionNivel.value) {
      return;
    }
    const [nivel] = nivelsCadastrados.filter((nivel) => nivel.id == optionNivel.value);
    inputNome.value = nivel.name;
    checkAuxiliar.checked = nivel.requires_auxiliary;
    checkPodeAuxiliar.checked = nivel.can_be_auxiliary;
  }

  function init(){
    optionNivel.selectedIndex = "1";
    setOptionNivel();
  }

  init();
</script>
@endsection
