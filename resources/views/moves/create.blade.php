@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New Move</div>
                    <div class="card-body">
                        <form action="/moves" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="descricao">Descricao</label>
                                <input type="text" class="form-control{{$errors->has('descricao') ? ' border-danger' : '' }}" id="descricao" name="descricao" value="{{old('descricao')}}">
                                <small class="form-text text-danger">{!! $errors->first('descricao') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" class="form-control{{$errors->has('data') ? ' border-danger' : '' }}" id="data" name="data" value="{{old('data')}}">
                                <small class="form-text text-danger">{!! $errors->first('data') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control{{$errors->has('valor') ? ' border-danger' : '' }}" id="valor" name="valor" value="">
                                <small class="form-text text-danger">{!! $errors->first('valor') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="entrada" selected>Entrada</option>
                                    <option value="saida">Saída</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="especificacao">Especificação</label>
                                <input type="text" class="form-control{{$errors->has('especificacao') ? ' border-danger' : '' }}" id="especificacao" name="especificacao" value="">
                                <small class="form-text text-danger">{!! $errors->first('especificacao') !!}</small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Move">
                        </form>
                        <a class="btn btn-primary float-right" href="/moves"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection