@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
               <h1 class="text-3xl">New Tour</h1>
            </header>

            <div class="w-full p-6 flex">
                <form class="w-full space-y-6 sm:space-y-8" method="POST"
                    action="{{ route('tours.store') }}">
                    @csrf

                    @include('tours.parts.form-fields')

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="btn-primary w-full relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center">
                            {{ __('Add new Tour') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
