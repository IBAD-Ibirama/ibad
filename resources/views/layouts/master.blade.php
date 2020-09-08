<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <script src={{ asset('js/app.js') }} async></script>
</head>
<body>
    <div class="p-3 text-center">
        <h1>@yield('title')</h1>
        @hasSection('subtitle')
            <h5>@yield('subtitle')</h5>
        @endif
        @yield('content')
    </div>
</body>
@yield('scripts')
</html>