@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @can('treinador')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>{{ $training->description() }} - Criar nova atividade</span>
          <a class="btn btn-warning btn-sm" href="{{ route('plannings.index', compact('team', 'training')) }}"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          @if ($planning->exists)
          <form method="POST" action="{{ route('plannings.update', $planning) }}">
            @method('PUT')
          @else
          <form method="POST" action="{{ route('plannings.store') }}">
          @endif
            @csrf
        
            <input type="hidden" name="training_id" value="{{ $training->id }}">
        
            <div class="form-group">
              <label for="name" class="@error('name') text-danger @enderror">Nome</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $planning->name) }}" aria-describedby="nameHelp" placeholder="Insira o nome da atividade" required maxlength="50">
              @error('name') <small id="nameHelp" class="form-text text-danger">{{ $message }}</small> @enderror
            </div>
        
            <div class="form-group">
              <label for="description" class="@error('description') text-danger @enderror">Descrição</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" aria-describedby="descriptionHelp" rows="3" required maxlength="200" placeholder="Insira a descrição da atividade">{{ old('description', $planning->description) }}</textarea>
              @error('description') <small id="descriptionHelp" class="form-text text-danger">{{ $message }}</small> @enderror
            </div>
        
            <button type="submit" class="btn btn-primary">Gravar</button>
          </form>
        </div>
      </div>
      @else

      <p>Você não tem permissão para acessar essa funcionalidade.</p>

      @endcan
    </div>
  </div>
</div>
@endsection