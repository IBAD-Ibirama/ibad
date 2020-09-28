@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('financeiro')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Editar movimentação</span>
                    <a class="btn btn-warning btn-sm" href="/movimentacoes"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
                </div>

                <div class="card-body">
                    <form action="/movimentacoes/{{$moves->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="user">Usuário</label>
                            <select name="usuario" id="usuario" class="form-control">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control{{$errors->has('description') ? ' border-danger' : '' }}" id="description" name="description" value="{{$moves->description ?? old('description')}}">
                            <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" class="form-control{{$errors->has('date') ? ' border-danger' : '' }}" id="date" name="date" value="{{$moves->date ?? old('date')}}">
                            <small class="form-text text-danger">{!! $errors->first('date') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="value">Valor</label>
                            <input type="text" class="form-control{{$errors->has('value') ? ' border-danger' : '' }}" id="value" name="value" value="{{$moves->value ?? old('value')}}">
                            <small class="form-text text-danger">{!! $errors->first('value') !!}</small>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control">
                                <option value="entrada" {{ $moves->type == 'entrada' ? 'selected' : '' }}>Entrada</option>
                                <option value="saida" {{ $moves->type == 'saida' ? 'selected' : '' }}>Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="specification">Especificação</label>
                            <input type="text" class="form-control{{$errors->has('specification') ? ' border-danger' : '' }}" id="specification" name="specification" value="{{$moves->specification ?? old('specification')}}">
                            <small class="form-text text-danger">{!! $errors->first('specification') !!}</small>
                        </div>
                        <input class="btn btn-primary mt-4" type="submit" value="Atualizar movimentação">
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
