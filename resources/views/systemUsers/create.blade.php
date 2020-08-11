@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create New User</div>
                    <div class="card-body">
                        <form action="/systemUser" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control{{$errors->has('name') ? ' border-danger' : '' }}" id="name" name="name" value="{{old('name')}}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{old('email')}}">
                                <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control{{$errors->has('password') ? ' border-danger' : '' }}" id="password" name="password" value="">
                                <small class="form-text text-danger">{!! $errors->first('password') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="permission">Permission</label>
                                <select name="permission" id="permission" class="form-control">
                                    <option value="adm" selected>Adm</option>
                                    <option value="user">User</option>
                                    <option value="financial">Financial</option>
                                </select>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save User">
                        </form>
                        <a class="btn btn-primary float-right" href="/systemUser"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection