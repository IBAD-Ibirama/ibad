<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IBAD</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Verifique o seu endereço de email') }}</div>

          <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{ __('Um email com link para troca de senha foi enviado.') }}
            </div>
            @endif

            {{ __('Antes de proceder, verifique o seu endereço de email.') }}
            {{ __('Se você não recebeu o email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para receber outro') }}</button>.
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
