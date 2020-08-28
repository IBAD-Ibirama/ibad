@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Todos os patrocinadores</span>
          <a class='btn btn-success btn-sm' href="/patrocinadores/create">Criar novo patrocinador</a>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach($sponsors as $sponsor)
            <li class="list-group-item">
              <a href="/patrocinadores/{{$sponsor->id}}" title="Consultar">{{$sponsor->name}}</a>

              <div class="float-right flex">
                <a class="btn btn-sm btn-light mr-2" href="/patrocinadores/{{$sponsor->id}}/edit">Editar</a>

                <form style="display: inline" action="/patrocinadores/{{$sponsor->id}}" method="post">
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
