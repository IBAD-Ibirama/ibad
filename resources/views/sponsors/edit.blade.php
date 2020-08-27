@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Editar recebimento de patrocinador</span>
          <a class="btn btn-primary" href="/sponsors"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>

        <div class="card-body">
          <form action="/sponsors/{{$sponsors->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="cnpj">CNPJ</label>
              <input type="text" class="form-control{{$errors->has('cnpj') ? ' border-danger' : '' }}" id="cnpj" name="cnpj" value="{{$sponsors->cnpj ?? old('cnpj')}}">
              <small class="form-text text-danger">{!! $errors->first('cnpj') !!}</small>
            </div>
            <div class="form-group">
              <label for="newvalue">Novo valor</label>
              <input type="number" class="form-control{{$errors->has('newvalue') ? ' border-danger' : '' }}" id="newvalue" name="newvalue" value="">
              <small class="form-text text-danger">{!! $errors->first('newvalue') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{$sponsors->email ?? old('email')}}">
              <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
            </div>

            <div class="form-group">
              <label for="permission">Permissão</label>
              <select name="permission" id="permission" class="form-control">
                @foreach($roles as $role)

                

                @endforeach
              </select>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Atualizar pagamento">
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
