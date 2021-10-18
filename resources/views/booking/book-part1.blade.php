@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full m-auto md:max-w-4xl sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between bg-gray-200 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="text-4xl font-semibold mb-2 text-gray-700">
                    Book your <span class="text-orange-500">{{ $tour->title }}</span> now!
                </h1>
                <div class="flex flex-col justify-end">
                    <h3 class="text-md font-semibold mb-2 text-gray-700">
                        page 1 of 3
                    </h3>
                </div>
            </header>

            <div class="w-full p-6 flex">
                @if($bookingCount > $tour->max_bookings )
                <div class="py-10 text-center w-full">
                    <h2 class="text-2xl font-bold mb-4">Booking full</h2>
                    <p>Please contact <a class="font-bold underline" href="mailto:info@bikeplanet.com">info@bikeplanet.com</a> for more information </p>
                </div>
                @else
                <form class="w-full space-y-6 sm:space-y-8" method="POST"
                    action="{{ route('booking.part1') }}">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{$tour->id}}">

                    <div class="w-full">
                        <h3 class="text-2xl font-semibold mb-2 text-gray-700">Contact information</h3>
                    </div>

                    @if($tour->booking_form === 'normal')
                    @include('booking.forms.normal')
                    @endif

                    @if($tour->booking_form === 'hotel-form')
                    @include('booking.forms.hotel-form')
                    @endif

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4">
                            {{ __('Continue') }}
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </section>
    </div>
</main>
@endsection
