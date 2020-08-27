@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('All the moves') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($moves as $move)
                                <li class="list-group-item">
                                   <a href="/moves/{{$move->id}}" title="Show Details">{{$move->descricao}}</a> 
                                   <a class="btn btn-sm btn-light ml-2" href="/moves/{{$move->id}}/edit">Edit move</a> 
                                   <form class="float-right" style="display: inline" action="/moves/{{$move->id}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                                   </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
            </div>
            <div class="mt-2">
                <a class='btn btn-success btn-sm' href="/moves/create">Create new move</a>
            </div>
        </div>
    </div>
</div>
@endsection