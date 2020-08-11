@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('User Detail') }}</div>
                    <div class="card-body">
                        <b>{{$systemUser->name}}</b>
                        <p>Email: {{$systemUser->email}}</p>
                        <p>Permission: {{$systemUser->permission}}</p>
                    </div>
            </div>
            <div class="mt-2">
                <a class='btn btn-success btn-sm' href="/systemUser">Back to overview</a>
            </div>
        </div>
    </div>
</div>
@endsection