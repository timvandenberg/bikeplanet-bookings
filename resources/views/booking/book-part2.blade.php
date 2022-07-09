@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full m-auto md:max-w-4xl sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between flex-wrap sm:no-wrap bg-gray-200 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="w-full sm:w-2/3 text-2xl sm:text-4xl font-semibold mb-2 text-gray-700">
                    Contact information
                </h1>
                <div class="w-full sm:w-1/3  flex justify-end items-start">
                    <div class="flex flex-col justify-end">
                        <h3 class="text-sm sm:text-md font-semibold mb-2 pt-2 text-gray-700">
                            page 2 of 4
                        </h3>
                    </div>
                </div>
            </header>

            <div class="w-full p-6 flex">
                <form class="w-full space-y-6 sm:space-y-8" method="POST"
                    action="{{ route('booking.part3') }}">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{$tour->id}}">

                    @if($tour->tour_type === 'iris')
                        @include('booking.forms.normal')
                    @endif

                    @if($tour->tour_type === 'primadonna')
                        @include('booking.forms.normal')
                    @endif

                    @if($tour->tour_type === 'hotel-form')
                        @include('booking.forms.hotel-form')
                    @endif

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4">
                            {{ __('Continue') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
