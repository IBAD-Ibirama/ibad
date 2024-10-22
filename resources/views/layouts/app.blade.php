<!doctype html>
@php
$athlete = null;
$user = Auth::user();
if($user){
    $athlete = \App\Athlete::where('user_id', $user->id)->first();
}
@endphp
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IBAD</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    IBAD
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link {{Request::is('dashboard') ? 'active' : ''}}" href="/">Dashboard</a></li>
                        @role('admin')
                        <li class="nav-item"><a class="nav-link {{Request::is('usuarios*') ? 'active' : ''}}" href="/usuarios">Usuários</a></li>
                        <li class="nav-item"><a class="nav-link {{Request::is('responsaveis*') ? 'active' : ''}}" href="/responsaveis">Responsáveis</a></li>
                        <li class="nav-item"><a class="nav-link" href="/atleta/desempenho">Desempenho dos atletas<span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a id="competitionsDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Competições <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="competitionsDropdown">
                                <a class="nav-link dropdown-item{{Request::is('competicao*') ? ' active' : ''}}" href="/competicao">Consulta de Competições<span class="sr-only">(current)</span></a>
                                <a class="nav-link dropdown-item{{Request::is('competicoes/relatorio*') ? ' active' : ''}}" href="/competicoes/relatorio">Relatório de Competição<span class="sr-only">(current)</span></a>
                                <a class="nav-link dropdown-item{{Request::is('atletas/registerAthleteCompetition*') ? ' active' : ''}}"" href="/atleta/registroPraticipacaoAtleta">Registrar participação do atleta<span class="sr-only">(current)</span></a>
                            </div>
                        </li>
                        @endrole
                        
                        @role('atleta')
                        <li class="nav-item dropdown">
                            <a id="traineeDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Treinador <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="traineeDropdown">
                                <a class="nav-link dropdown-item{{Request::is('frequencia*') ? ' active' : ''}}" href="/frequencia">Consulta de Frequências<span class="sr-only">(current)</span></a>
                                <a class="nav-link dropdown-item{{Request::is('/atleta/dados*') ? ' active' : ''}}" href="/atleta/dados">Consulta de dados<span class="sr-only">(current)</span></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/financeiro">Relatório Financeiro<span class="sr-only">(current)</span></a>
                        </li>
                        @if($athlete && $athlete->id)
                        <li class="nav-item">
                            <a class="nav-link" href="/atleta/desempenho/{{$athlete->id}}">Desempenho do atleta<span class="sr-only">(current)</span></a>
                        </li>
                        @endif
                        @endrole

                        @can('treinador')
                        <li class="nav-item dropdown">
                            <a id="coachDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Treinador <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="coachDropdown">
                                <a class="dropdown-item {{Request::is('atletas*') ? 'active' : ''}}" href="/atletas">Atletas</a>
                                <a class="dropdown-item {{Request::is('turmas*') ? 'active' : ''}}" href="/turmas">Turmas</a>
                                <a class="dropdown-item {{Request::is('limiteDeFalta*') ? 'active' : ''}}" href="{{route('fault.show')}}">Limite de Faltas</a>
                                <a class="dropdown-item {{Request::is('treinos*') ? 'active' : ''}}" href="/treinos">Treinos</a>
                                <a class="dropdown-item {{Request::is('frequencias*') ? 'active' : ''}}" href="{{ route('frequency.index') }}">Frequências</a>
                            </div>
                        </li>
                        @endcan

                        @can('financeiro')
                        <li class="nav-item dropdown">
                            <a id="financialDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Financeiro <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="financialDropdown">
                                <a class="dropdown-item {{Request::is('movimentacoes*') ? ' active' : ''}}" href="/movimentacoes">Movimentações</a>
                                <a class="dropdown-item {{Request::is('patrocinadores*') ? ' active' : ''}}" href="/patrocinadores">Patrocinadores</a>
                            </div>
                        </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(isset($message_success) || Session::has('success'))
            <div class="container">
                <div class="alert alert-success" role="alert">
                    {!! isset($message_success) ? $message_success : Session::get("success") !!}
                </div>
            </div>
            @endif

            @if(isset($message_warning) || Session::has('warning'))
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    {!! isset($message_warning) ? $message_warning : Session::get("warning") !!}
                </div>
            </div>
            @endif

            @if(isset($message_failure) || Session::has('failure'))
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    {!! isset($message_failure) ? $message_failure : Session::get("failure") !!}
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>