@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Detalhes da turma</span>
          <a class='btn btn-success btn-sm' href="/turmas/{{ $team->id }}">Voltar</a>
        </div>

        <div class="card-body">
          <form action="{{ route('athlete.matriculate', $team->id) }}" method="POST">
            @csrf

            <label for="athlete"> Escolha o Atleta:</label>

            <div class="form-group">
              <select id="athlete" class="form-control" name="athlete_id">
                <option>
                </option>
                @foreach($athletes as $athlete)
                <option value='{{$athlete->id}}'>
                  {{$athlete->user->id}} - {{$athlete->user->name}}
                </option>;
                @endforeach
              </select>
            </div>

            <label>Atleta</label>
            <table class='table'>
              <tr>
                <th style="width: 100px">Nome:</th>
                <th id='athlete_name'></th>
              </tr>
              <tr>
                <th style="width: 100px">Data de Inscrição:</th>
                <th id='athlete_date'></th>
              </tr>
            </table>

            <label>Turma a qual pertence</label>
            <table class='table'>
              <tr>
                <th style="width: 100px">Nome:</th>
                <th id='team_name'></th>
              </tr>
              <tr>
                <th style="width: 100px">Nivel:</th>
                <th id='team_level'></th>
              </tr>
            </table>
            <button class="btn btn-sm-block btn-success">Adicionar</button>
          </form>
          @else

          <p>Você não tem permissão para acessar essa funcionalidade.</p>

          @endrole
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const allAthletes =  {!! json_encode($athletes) !!};
  const allTeam =  {!! json_encode($teams) !!};
  const allLeveis =  {!! json_encode($teamLevels) !!};

  const athleteName = document.querySelector('#athlete_name');
  const athleteSingUp = document.querySelector('#athlete_date');
  const teamName = document.querySelector('#team_name');
  const teamLevel = document.querySelector('#team_level');
  const optionNivel = document.querySelector('#athlete');

  optionNivel.onchange = () => {
    const athleteId = optionNivel.value;
    if(!optionNivel.value) return;
    const [athlete] = allAthletes.filter((athlete) => athlete.id == athleteId);

    athleteName.innerHTML = athlete.user.name;

    const date = athlete.created_at.substr(0, 10).split('-');
    athleteSingUp.innerHTML = date.join('/');
    const [team] = allTeam.filter((team) => team.id === athlete.team_id);

    if(!team) {
      teamName.innerHTML = 'Sem Vinculo a Turma';
      teamLevel.innerHTML = "";
    } else {
      teamName.innerHTML = team.name;
      const [level] = allLeveis.filter(level => level.id === team.team_level_id);
      teamLevel.innerHTML = level.name;
    }

  }
</script>
@endsection
