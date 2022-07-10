@extends('layouts.app')

@section('content')
<main class="bike-container sm:mx-auto sm:mt-12">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex sm:mt-4 flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <div class="flex justify-between flex-wrap sm:flex-nowrap ">
                    <div class="titlebox w-1/2 sm:w-auto mt-2">
                        <h1 class="text-3xl md:text-4xl inline mr-2">Dashboard</h1>
                    </div>

                    <div class="relative w-1/2 sm:w-auto sm:w-auto flex justify-end items-center sm:block">
                        <div class="relative">
                            <a
                                href="/tours/create"
                                class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap
                                px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline
                                text-gray-100 bg-orange-500 text-center"
                            >
                                New Tour
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="w-full p-6 pt-2 sm:pt-6 flex md:flex-wrap overflow-x-auto md:overflow-visible">
                <livewire:tours-table />
            </div>
        </section>
    </div>
</main>
@endsection
