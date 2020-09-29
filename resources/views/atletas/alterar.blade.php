@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('admin')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Registrar participação do atleta </span>
                    <a class="btn btn-warning btn-sm" href="/atleta/registroPraticipacaoAtleta"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ URL::to('atleta/registroPraticipacaoAtleta/atualizar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{$registro->id}}">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="athlete">Atleta</label>
                                    <input class="form-control" id="athlete" name="athlete" value="{{$registro->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="place">Competição</label>
                                    <select class="form-control" id="competition" name="competition">
                                        @foreach($competitions as $competition)
                                            <option value="{{$competition->id}}" {{ $competition->id == $registro->competition_id ? 'selected' : '' }}>{{$competition->place}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="modality">Modalidade</label>
                                    <select class="form-control" id="modality" name="modality">
                                        @foreach($modalities as $modality)
                                            <option value="{{$modality->id}}" {{ $modality->id == $registro->modality_id ? 'selected' : '' }}>{{$modality->player_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria</label>
                                    <select class="form-control" id="category" name="category">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ $category->id == $registro->category_id ? 'selected' : '' }}>{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="result">Resultado</label>
                                    <select class="form-control" id="result" name="result">
                                        <option value="Ouro" {{ $registro->results == 'Ouro' ? 'selected' : '' }}>Ouro</option>
                                        <option value="Prata" {{ $registro->results == 'Prata' ? 'selected' : '' }} >Prata</option>
                                        <option value="Bronze" {{ $registro->results == 'Bronze' ? 'selected' : '' }}>Bronze</option>
                                        <option value="Participante" {{ $registro->results == 'Participante' ? 'selected' : '' }}>Participante</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Salvar">
                    </form>
                </div>
            </div>
            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>

            @endrole
        </div>
    </div>
</div>
@endsection