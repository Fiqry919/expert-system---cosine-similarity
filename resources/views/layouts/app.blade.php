<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    {{-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> --}}

    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
    integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Loader -->
    <link rel="stylesheet" href="{{asset('loader/dist/css-loader.css')}}">
    @yield('css')
    <style>
        /* effect required */
        .required:after {
            content:" *";
            color: red;
        }
        /* effect readonly */
        select[readonly] {
        background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
        pointer-events: none;
        touch-action: none;
        }
        /* nav color */
        .navbar-nav .nav-item.active .nav-link,
        .navbar-nav .nav-item .nav-link:active,
        .navbar-nav .nav-item .nav-link:focus,
        .navbar-nav .nav-item:hover .nav-link {
            color: #0090e0;
        }
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu{ display: none; }
            .navbar .nav-item:hover .nav-link{   }
            .navbar .nav-item:hover .dropdown-menu{ display: block; }
            .navbar .nav-item .dropdown-menu{ margin-top:0; }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand font-italic" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (empty(Auth::user()))
                        <ul class="navbar-nav mr-auto">
                            @if (Route::is('konsultasi.index'))
                                <li class="nav-item {{ Route::is('konsultasi.index') ? 'active' : '' }}">
                                    <a href="{{route('konsultasi.index')}}" class="nav-link">Daftar</a>
                                </li>
                            @endif
                            @if (Route::is('guest.index'))
                                <li class="nav-item {{ Route::is('guest.index') ? 'active' : '' }}">
                                    <a href="{{route('guest.index')}}" class="nav-link">Forward Chaining</a>
                                </li>
                            @endif
                            @if (Route::is('select.index'))
                                <li class="nav-item {{ Route::is('select.index') ? 'active' : '' }}">
                                    <a href="{{route('select.index')}}" class="nav-link">Similarity</a>
                                </li>
                            @endif
                            @if (Route::is('guest.store'))
                                <li class="nav-item {{ Route::is('guest.store') ? 'active' : '' }}">
                                    <a href="{{route('guest.index')}}" class="nav-link">Hasil</a>
                                </li>
                            @endif
                            @if (Route::is('konsultasi.store'))
                                <li class="nav-item {{ Route::is('konsultasi.store') ? 'active' : '' }}">
                                    <a href="{{route('konsultasi.index')}}" class="nav-link">Hasil</a>
                                </li>
                            @endif
                        </ul>
                    @endif

                    @if (!empty(Auth::user()))
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Route::is('penyakit.index') ? 'active' : '' }}">
                            <a href="{{route('penyakit.index')}}" class="nav-link">Penyakit</a>
                        </li>
                        <li class="nav-item {{ Route::is('gejala.index') ? 'active' : '' }}">
                            <a href="{{route('gejala.index')}}" class="nav-link">Gejala</a>
                        </li>
                        <!-- WITH DROPDOWN -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Cosine Similarity
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ Route::is('aturan.index') ? 'active' : '' }}" href="{{route('aturan.index')}}">Data Kasus</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Forward Chaining
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ Route::is('question.index') ? 'active' : '' }}" href="{{route('question.index')}}">Rules</a>
                                <a class="dropdown-item {{ Route::is('history.index') ? 'active' : '' }}" href="{{route('history.index')}}">History</a>
                            </div>
                        </li>
                        <!-- WITHOUT DROPDOWN DISABLED -->
                        {{-- <li class="nav-item {{ Route::is('aturan.index') ? 'active' : '' }}">
                            <a href="{{route('aturan.index')}}" class="nav-link">Similarity</a>
                        </li>
                        <li class="nav-item {{ Route::is('question.index') ? 'active' : '' }}">
                            <a href="{{route('question.index')}}" class="nav-link">Forward Chaining</a>
                        </li>
                        <li class="nav-item {{ Route::is('history.index') ? 'active' : '' }}">
                            <a href="{{route('history.index')}}" class="nav-link">History</a>
                        </li> --}}
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- LIBARARY JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('js')
    <!-- AKHIR LIBARARY JS -->
</body>
</html>
