<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
<div class="flex flex-col">
    @if(Route::has('login'))
        <div class="absolute top-0 right-0 mt-4 mr-4 space-x-4 sm:mt-6 sm:mr-6 sm:space-x-6">
            @if(false)
                @auth
                    <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Home') }}</a>
                @else
                    <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Register') }}</a>
                    @endif
                @endauth
            @endif
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full px-4">
            <div>
                <p class="text-center bold sm:text-2xl mb-6 sm:mb-10" style="color: #074161">Welcome at</p>

                <h1 class="flex justify-center mb-6 text-center font-bold tracking-wider text-2xl md:text-4xl lg:text-6xl sm:mb-8 ">
                    <span style="color: #074161">BIKE</span>
                    <span style="color: #F19C26">PLANET</span>
                    <span style="color: #074161">booking</span>
                    <span style="color: #F19C26">.com</span>
                </h1>

                <p class="text-center bold sm:text-2xl sm:leading-8" style="color: #074161">This is our booking website.<br>
                    Visit our tour website for
                    <a href="https://www.bikeplanet.tours/bike-tours/" target="_blank" class="bold sm:text-2xl" style="color: #F19C26">
                        all Tours
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
