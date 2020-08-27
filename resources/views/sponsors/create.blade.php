@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @role('admin')

      <div class="card">
        <div class="card-header row w-100 align-items-start justify-content-between" style="margin: 0;">
          <span>Criar pagamento de patrocinador</span>
          <a class="btn btn-primary" href="/usuarios"><i class="fas fa-arrow-circle-up"></i> Voltar</a>
        </div>
        <div class="card-body">
          <form action="/usuarios" method="post">
            @csrf
            <div class="form-group">
              <label for="cnpj">CNPJ</label>
              <input type="text" class="form-control{{$errors->has('name') ? ' border-danger' : '' }}" id="cnpj" name="cnpj" value="{{old('cnpj')}}">
              <small class="form-text text-danger">{!! $errors->first('cnpj') !!}</small>
            </div>
            <div class="form-group">
              <label for="value">Valor</label>
              <input type="value" class="form-control{{$errors->has('value') ? ' border-danger' : '' }}" id="value" name="value" value="">
              <small class="form-text text-danger">{!! $errors->first('value') !!}</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control{{$errors->has('email') ? ' border-danger' : '' }}" id="email" name="email" value="{{old('email')}}">
              <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
            </div>
            <div class="form-group">
              <label for="permission">Permissão</label>
              <select name="permission" id="permission" class="form-control">
                @foreach($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
              </select>
            </div>
            <input class="btn btn-primary mt-4" type="submit" value="Salvar registro">
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
