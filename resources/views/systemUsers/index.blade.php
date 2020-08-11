@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('All the users') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($systemUsers as $systemUser)
                                <li class="list-group-item">
                                   <a href="/systemUser/{{$systemUser->id}}" title="Show Details">{{$systemUser->name}}</a> 
                                   <a class="btn btn-sm btn-light ml-2" href="/systemUser/{{$systemUser->id}}/edit">Edit user</a> 
                                   <form class="float-right" style="display: inline" action="/systemUser/{{$systemUser->id}}" method="post">
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
                <a class='btn btn-success btn-sm' href="/systemUser/create">Create new user</a>
            </div>
        </div>
    </div>
</div>
@endsection