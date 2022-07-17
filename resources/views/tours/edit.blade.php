@extends('layouts.app')

@section('content')
<main class="bike-container sm:mx-auto">
    <div class="w-full sm:px-6">

        <div class="bg-gray-100 py-4">
            <a href="/tours/{{ $tour->id }}" class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center ml-6 sm:ml-0">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <h1 class="text-3xl">Edit Tour</h1>
            </header>

            <div class="w-full p-6 flex">
                <form class="w-full space-y-6 sm:space-y-8" method="POST"
                    action="{{ route('tours.update', $tour) }}">
                    @csrf

                    <input type="hidden" name="_method" value="patch">

                    @include('tours.parts.form-fields')

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4">
                            {{ __('Pas aan') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
