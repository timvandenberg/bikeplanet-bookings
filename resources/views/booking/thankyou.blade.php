@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <h1 class="text-4xl mb-4 inline mr-4">Thankyou!</h1>

            </header>

            <div class="w-full p-6">
                <p class="text-lg inline">
                    Thanks for signing up for {{ $tour->title }}
                </p>
            </div>
        </section>
    </div>
</main>
@endsection
