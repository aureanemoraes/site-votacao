<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Painel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} - Painel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{!! url('painel') !!}">Painel</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <ul class="list-group">
                                    <li class="list-group-item"><h4 class="text-center">Menu</h4></li>
                                    @if(url()->current()!=url('/painel'))
                                        <li class="list-group-item"><a href="{!! url('painel') !!}">Painel</a></li>
                                    @endif
                                    <li class="list-group-item"><a href="{!! url('/') !!}">Voltar Para O Site</a></li>
                                    <li class="list-group-item"><a href="{{ url('painel/adicionar-tema') }}">Criar Tema</a></li>
                                    @if(Auth::user()->level>=0)
                                        <li class="list-group-item"><a href="{{ url('painel/meus-temas') }}">Meus Temas</a></li>
                                    @endif
                                    @if(Auth::user()->level>=1)
                                        <li class="list-group-item"><a href="{{ url('painel/listar-temas') }}">Listar Temas</a></li>
                                        <li class="list-group-item"><a href="{!! url('painel/listar-removidos') !!}">Listar Removidos</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-9">
                                    @yield('content')

                            </div>

            </div>

        </div>
    </div>
</body>
</html>
