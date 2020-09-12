@extends('layouts.master')

@section('title', ($planning->exists ? 'Alterar' : 'Cadastrar') . ' Atividade')
@section('subtitle', $team->name . ' - Treino em ' . date('d/m/Y', strtotime($training->date)))

@section('content')
<div class="text-left">

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
    <a class="btn btn-secondary" href={{ route('plannings.index', compact('team', 'training')) }} role="button">Voltar para Atividades</a>

  </form>
</div>
@endsection