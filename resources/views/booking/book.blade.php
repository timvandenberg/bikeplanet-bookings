@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full m-auto sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class=" bg-gray-200 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <h1 class="text-4xl font-semibold mb-2 text-gray-700">
                    New booking
                </h1>
                <h2 class="text-xl font-semibold text-gray-700">{{ $tour->title }} ( {{ $tour->season }} )</h2>
            </header>

            <div class="w-full p-6 flex">
                @if($bookingCount > $tour->max_bookings )
                <div class="py-10 text-center w-full">
                    <h2 class="text-2xl font-bold mb-4">Booking full</h2>
                    <p>Please contact <a class="font-bold underline" href="mailto:info@bikeplanet.com">info@bikeplanet.com</a> for more information </p>
                </div>
                @else
                <form class="w-full space-y-6 sm:space-y-8" method="POST"
                    action="{{ route('booking.store') }}">
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


                    <div class="relative">
                        <h3 class="text-2xl font-semibold mb-4 text-gray-700">Travel Group</h3>
                    </div>
                    <div class="relative">
                        <p class="inline mb-2">How many people are travaling?</p>
                    </div>
                    <div class="relative inline mt-2">
                        <select class="form-input" name="input_total_person_count" id="select_total_persons">
                            <option value="1">1 person</option>
                            <option value="2">2 person</option>
                            <option value="3">3 person</option>
                            <option value="4">4 person</option>
                            <option value="5">5 person</option>
                            <option value="6">6 person</option>
                            <option value="7">7 person</option>
                            <option value="8">8 person</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <div class="w-full flex mb-2">
                            <div class="text-md mr-10">&nbsp;&nbsp;&nbsp;</div>
                            <div class="w-1/4 font-semibold">Name</div>
                            <div class="w-1/4 font-semibold">Email</div>
                            <div class="w-1/4 font-semibold">Bike</div>
                            <div class="w-1/4 font-semibold">Food</div>
                        </div>

                        @for($nr = 1; $nr < 9; $nr++)
                        @include('booking.forms.person-fields')
                        @endfor
                    </div>
                    {{-- persons --}}


                    <div class="w-full mb-4">
                        <input id="client_profile" name="client_profile" type="checkbox">
                        <label for="client_profile">Create client profile</label>
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                            {{ __('Book now') }}
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </section>
    </div>
</main>
@endsection
