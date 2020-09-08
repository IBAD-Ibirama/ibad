@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('financeiro')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Todas as movimentações</span>
          <a class='btn btn-success btn-sm' href="/movimentacoes/create">Criar nova movimentação</a>
        </div>
        <div class="card-body">
          <ul class="list-group">
            @foreach($moves as $move)
            <li class="list-group-item">
              <a href="/movimentacoes/{{$move->id}}" title="Mostrar detalhes">{{$move->description}}</a>

              <div class="float-right flex">
                <a class="btn btn-sm btn-light mr-2" href="/movimentacoes/{{$move->id}}/edit">Editar</a>

                <form style="display: inline" action="/movimentacoes/{{$move->id}}" method="post">
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
