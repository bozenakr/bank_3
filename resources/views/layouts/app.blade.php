<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/back/app.scss', 'resources/js/back/app.js'])
</head>
<body>
    <header>
        <div class="container header">
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
            </a> --}}
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            </button> --}}

            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
            <!-- Left Side Of Navbar -->
            <div class="header-menu">
                <img class="logo" src="../../public/assets/logoIdea.jpg" alt="logo">
                <a class="header-link" href="{{route('customers-index')}}">Client list</a>
                <a class="header-link" href="{{route('customers-create')}}">New account</a>
            </div>



            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            </a>

            <!-- Right Side Of Navbar -->
            <div> Hello, {{ Auth::user()->name }}!</div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                <a class="btn btn-logout" href="{{ route('logout') }}" onclick="event.preventDefault();

                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                @csrf
            </form>
    </header>
    @endguest
    </ul>
    </div>
    </div>
    </nav>

    <main class="py-4">
        @include('layouts.messages')
        @yield('content')
    </main>
    </div>
</body>
</html>
