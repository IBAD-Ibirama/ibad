@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('treinador')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $athlete->user->name }} - Todas as avaliações</span>
          <div>
            <a class="btn btn-success btn-sm" href="{{ route('evaluations.create', compact('athlete')) }}">Criar nova avaliação</a>
            <a class="btn btn-warning btn-sm" href="{{ route('atletas.index') }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
          </div>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach ($evaluations as $evaluation)
            <li class="list-group-item">
                <a href="{{ route('evaluations.show', compact('athlete', 'evaluation')) }}" title="Mostrar detalhes">{{ $evaluation->description() }}</a>
  
                <div class="float-right flex">
                  <a class="btn btn-sm btn-light mr-2" href="{{ route('evaluations.edit', compact('athlete', 'evaluation')) }}">Editar</a>
  
                  <form style="display: inline" action="{{ route('evaluations.destroy', compact('evaluation')) }}" method="post">
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

      @endcan
    </div>
  </div>
</div>
@endsection