@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Todos os atletas</span>
          <a class='btn btn-success btn-sm' href="/atletas/create">Criar novo atleta</a>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach($athletes as $athlete)
            <li class="list-group-item">
              @if(file_exists('images/athletes/'. $athlete->id . '_thumb.jpg'))
              <a title="Show Details" href="/athlete/{{ $athlete->id }}">
                <img src="/images/athletes/{{$athlete->id}}_thumb.jpg" alt="User Thumb">
              </a>
              @endif
              <a href="/atletas/{{$athlete->id}}" title="Mostrar detalhes">{{$athlete->user->name}}</a>

              <div class="float-right flex">
                <a class="btn btn-sm btn-light mr-2" href="/atletas/{{$athlete->id}}/edit">Editar</a>

                <form style="display: inline" action="/atletas/{{$athlete->id}}" method="post">
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
