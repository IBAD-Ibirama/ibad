@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">

            @can('treinador')

            <div class="card">
                <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
                    <span>Definir novo limite de faltas</span>
                    <a class="btn btn-warning btn-sm" href="{{route('fault.store')}}">
                        Voltar
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{route('fault.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="limit">Limite</label>
                            <input type="number" class="form-control{{$errors->has('limit') ? ' border-danger' : '' }}"
                                id="limit" name="limit" min="1" value="{{$faultLimit ? $faultLimit->limit : '' }}">
                            <small class="form-text text-danger">{!! $errors->first('limit') !!}</small>
                            <small id="emailHelp" class="form-text text-muted">
                                Esse limite de faltas passara a valer a partir de {{date("d-m-Y \a\s H:i")}}
                            </small>
                        </div>

                        <input type="submit" class="btn btn-primary mt-4" value="Definir Limite">
                    </form>
                </div>
            </div>

            @else

            <p>Você não tem permissão para acessar essa funcionalidade.</p>
            <div class="text-center">
                <a href="/" class="btn btn-light">Voltar para Dashboard</a>
            </div>

            @endcan

        </div>
    </div>
</div>
@endsection
