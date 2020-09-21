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
                    <span>Detalhes do Treino</span>
                    <a class='btn btn-success btn-sm' href="/turmas">Voltar</a>
                </div>

                <div class="card-body">
                    <h3><b>Treino da turma {{$team->name}}</b></h3>
                    <p>Do dia {{ (new DateTime(substr($training->date,0,10)))->format('d/m/Y')}}</p>
                </div>
            </div>

            <form action="" id='form' method="POST">
                @csrf

                <div class="card mt-3">
                    <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                        <span>Auxiliar</span>
                        <span class="mr-5" style="display: {{count($helps) == 0 ? 'none': 'block'}}">Presença</span>
                    </div>
                    <div class="card-body">

                        <ul class="list-group">
                            @forelse ($helps as $help)
                            <li class="list-group-item">
                                <th scope="col">{{ $help->id }} - {{ $help->name }}</th>
                                <div class="float-right flex mr-5-">
                                    <input type="checkbox" class="form-check-input"
                                        onclick="scoreAbsenceHelp(this, {{$help->id}})" checked />
                                </div>
                            </li>
                            @empty
                            <h3>Nenhum Auxiliar Encontrado</h3>
                            @endforelse
                        </ul>


                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                        <span>Atletas</span>
                        <span class="mr-5" style="display: {{count($athletes) == 0 ? 'none': 'block'}}">Presença</span>
                    </div>
                    <div class="card-body">

                        <ul class="list-group">
                            @forelse ($athletes as $athlete)
                            <li class="list-group-item">
                                <th scope="col">{{ $athlete->id }} - {{ $athlete->name }}</th>
                                <div class="float-right flex mr-5-">
                                    <input type="checkbox" class="form-check-input"
                                        onclick="markAbsenceAthlete(this, {{$athlete->id}})" checked />
                                </div>
                            </li>
                            @empty
                            <h3>Nenhum Atleta Encontrado</h3>
                            @endforelse
                        </ul>


                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('script')
<script>
    const athletes = {!! json_encode($athletes) !!};
    const helps = {!! json_encode($helps) !!};
    const url = '{{ route('frequency.store', $training->id)}}';
    const trainingID =  '{{ route('training.show', $training->id) }}';
    const data = { athletes, helps };
    $('form').on('submit', function (e) {
              e.preventDefault();
              $.ajax({
                  type: 'post',
                  url: url,
                  data: data,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
                success: function (respose) {
                    console.log(respose);
                    if(respose.code === 200){
                       window.location.href = trainingID;
                    } else if(respose.code === 500){
                        alert('Não foi possivel realizar a chamada');
                    }
          }
              });
          });
      form.onsubmit = function(event){
      event.preventDefault();
    }
    function allPresent(){
      athletes.forEach((athlete) =>{
        athlete.presence = true;
        return athlete;
      })
      helps.forEach((help) =>{
        help.presence = true;
        return help;
      })
    }
    function scoreAbsenceHelp(checkbox, id){
      const [help] = helps.filter(help => help.id == id);
      help.presence = checkbox.checked;
    }
    function markAbsenceAthlete(checkbox, id){
      const [athlete] = athletes.filter(athlete => athlete.id == id);
      athlete.presence = checkbox.checked;
      console.log(athlete)
    }
    allPresent();
</script>
@endsection