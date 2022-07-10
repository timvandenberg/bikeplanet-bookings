@extends('layouts.app')

@section('content')
<main class="bike-container sm:mx-auto">
    <div class="w-full sm:px-6 pb-10">

        <div class="bg-gray-100 py-4">
            <a href="/tours/{{ $booking->tour->id }}" class="relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 ml-6 sm:ml-0">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg mb-4">

            @include('booking.admin-parts.header')

            <div class="w-full p-6">
                <h4 class="text-xl sm:text-2xl bold">Booking status</h4>
                @include('booking.admin-parts.booking-status')

                @include('booking.admin-parts.price-actions')

                @include('booking.admin-parts.booking-info')

                @if($booking->extra_comments)
                <div class="w-full mb-7 py-2 border-t-2">
                    <h3 class="text-xl sm:text-2xl bold w-full my-4">Extra booking information</h3>
                    <p class="text-sm sm:text-md leading-5 text-gray-700">{{$booking->extra_comments}}</p>
                </div>
                @endif

                @if($booking->documents === 1 && $booking->active === 1)
                    @include('booking.admin-parts.document-links')
                @endif

            </div>
        </section>

        @include('booking.admin-parts.booking-actions')
    </div>
</main>
@endsection
