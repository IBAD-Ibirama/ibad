@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar nova turma</span>
          <a class="btn btn-warning btn-sm" href="/turmas"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>

        <div class="card-body">
          <form action="/turmas/" method="post">
            @csrf
            <div class="form-group">
              <label for="team_name">Nome</label>
              <input type="text" class="form-control" id="team_name" name="team_name">
            </div>

            <div class="row">
              <div class="col-md-8">
                <label for="level">Nivel Da Turma</label>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="teamLevel_name">Nome do Nivel:</label>
                      <input id='inputName' class="form-control" name="teamLevel_name">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="nivelOption">Niveis já existente</label>
                    <div class="form-group">
                      <select name="level_select" class="form-control" id="nivelOption">
                        <option value="">

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
                  Informe as caracteristicas dessa turma
                </small>
                <div class="form-check">
                  <input name="requires_auxiliary" type="checkbox" class="form-check-input" id="auxiliar">
                  <label class="form-check-label" for="auxiliar">
                    Turma ira requerer auxiliares durantes os Treinos
                  </label>
                </div>

                <div class="form-check">
                  <input name="can_be_auxiliary" type="checkbox" class="form-check-input" id="pode_auxiliar">
                  <label class="form-check-label" for="pode_auxiliar">
                    Os atletas dessa podem auxiliar outras turma nos Treinos
                  </label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="mt-5 mb-2 col-12 col-md-3">
                <input type="submit" class="btn btn-success btn-lg btn-sm-block" value="Criar nova Turma">
              </div>
            </div>
          </form>
        </div>
        @else

        <p>Você não tem permissão para acessar essa funcionalidade.</p>

        @endrole
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const nivelsCadastrados =  {!! json_encode($teamLevels) !!};
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

  optionNivel.onchange = () => {
    if(!optionNivel.value) {
      return;
    }
    const [nivel] = nivelsCadastrados.filter((nivel) => nivel.id == optionNivel.value);
    inputNome.value = nivel.name;
    checkAuxiliar.checked = nivel.requires_auxiliary;
    checkPodeAuxiliar.checked = nivel.can_be_auxiliary;
  }
</script>
@endsection
