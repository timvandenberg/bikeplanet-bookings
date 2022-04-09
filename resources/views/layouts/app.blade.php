<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

{{--    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>--}}

    <link href="{{ mix('css/app.css') }}?<?=rand()?>" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-100 h-screen antialiased leading-none regular">
    <div id="app">
        <header class="bg-blue-500 py-6">
            <div class="container mx-auto flex justify-center items-center px-6">
                <div>
                    <a href="{{ url('/home') }}" class="text-lg font-semibold text-gray-100 no-underline black flex">
                        <span class="text-white">BIKE</span>
                        <span class="text-orange-500">PLANET</span>
                        <span class="text-white">booking</span>
                        <span class="text-orange-500">.com</span>
                    </a>
                </div>
                <nav class="absolute right-6 space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a href="https://www.bikeplanet.tours/bike-tours/" target="_blank" class="bold ">All tours in Europe</a>
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        @yield('content')
    </div>
</body>

@livewireScripts
<script src="{{ asset('js/app.js') }}?<?=rand()?>" defer></script>
</html>


