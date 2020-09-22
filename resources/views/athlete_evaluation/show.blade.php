@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('treinador')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $athlete->user->name }} - {{ $evaluation->description() }}</span>
          <a class="btn btn-warning btn-sm" href="{{ route('evaluations.index', compact('athlete')) }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body row">
          <div class="col">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th width="70%">Teste Físico</th>
                  <th width="30%">Valor</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($physicalTests as $physicalTest)
                  @if ($value = $evaluation->physicalTest($physicalTest)->value)
                    <tr>
                      <td>{{ $physicalTest->name }}</td>
                      <td>{{ number_format($value, 3, ',', '.') }}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="col">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th width="70%">Índice Corporal</th>
                  <th width="30%">Valor</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bodyIndexes as $bodyIndex)
                  @if ($value = $evaluation->bodyIndex($bodyIndex)->value)
                    <tr>
                      <td>{{ $bodyIndex->name }}</td>
                      <td>{{ number_format($value, 3, ',', '.') }}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection