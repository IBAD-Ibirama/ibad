@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')
      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $training->description() }} - Todas as atividades planejadas</span>
          <div>
            <a class="btn btn-success btn-sm" href="{{ route('plannings.create', compact('team', 'training')) }}">Criar nova atividade</a>
            <a class="btn btn-warning btn-sm" href="{{ route('training.index', ['team' => $team->id]) }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
          </div>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach ($plannings as $planning)
            <li class="list-group-item">
                <a href="{{ route('plannings.show', compact('team', 'training', 'planning')) }}" title="Mostrar detalhes">{{ $planning->name }}</a>
  
                <div class="float-right flex">
                  <a class="btn btn-sm btn-light mr-2" href="{{ route('plannings.edit', compact('team', 'training', 'planning')) }}">Editar</a>
  
                  <form style="display: inline" action="{{ route('plannings.destroy', compact('planning')) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-sm btn-outline-danger" type="submit" value="Deletar">
                  </form>
                </div>
              </li>  
            @endforeach
          </ul>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endrole
    </div>
  </div>
</div>
@endsection