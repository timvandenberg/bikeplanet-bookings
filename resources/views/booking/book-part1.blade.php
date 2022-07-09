@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full m-auto md:max-w-4xl sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="flex justify-between flex-wrap sm:no-wrap bg-gray-200 py-5 px-6 sm:py-6 sm:rounded-t-md">
                    <h1 class="w-full sm:w-2/3 text-2xl sm:text-4xl font-semibold mb-2 text-gray-700">
                        Book your <a class="text-orange-500" href="{{ $tour->tour_website_link }}" target="_blank">{{ $tour->title }}</a> now!
                    </h1>
                    <div class="w-full sm:w-1/3 flex justify-end items-start">
                        <div class="flex flex-col justify-end">
                            <h3 class="text-sm sm:text-md font-semibold mb-2 pt-2 text-gray-700">
                                page 1 of 4
                            </h3>
                        </div>
                    </div>
                </header>

                <div class="w-full p-6 text-gray-700">
                    @if($bookingCount > $tour->max_bookings )
                        <div class="py-10 text-center w-full ">
                            <h2 class="text-xl sm:text-2xl font-bold mb-4">Booking full</h2>
                            <p>Please contact <a class="font-bold underline" href="mailto:info@bikeplanet.com">info@bikeplanet.com</a> for more information </p>
                        </div>
                    @else
                        <div class="flex flex-wrap sm:no-wrap">
                            <div class="w-full sm:w-1/2 mb-4 pr-4">
                                <h2 class="text-xl sm:text-3xl font-semibold mb-4">{{ $tour->form_title }}</h2>
                                <p class="text-sm sm:text-md text-gray-700">
                                    {{ $tour->form_text }}
                                </p>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <img class="w-full" src="{{ $tour->tour_image_link }}" alt="">
                            </div>
                        </div>
                        <div class="flex">
                            @if(!$referralCode)
                                <div class="py-10 text-center w-full ">
                                    <h2 class="text-xl sm:text-2xl font-bold mb-4">Referral code not correct</h2>
                                    <p>Please contact <a class="font-bold underline" href="mailto:info@bikeplanet.com">info@bikeplanet.com</a> for more information </p>
                                </div>
                            @else
                            <form class="w-full space-y-6 sm:space-y-8" method="POST"
                                  action="{{ route('booking.part2') }}">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{$tour->id}}">

                                <div class="w-full">
                                    <h3 class="text-xl sm:text-2xl font-semibold mb-2 text-gray-700">Please fill in your referral code below</h3>
                                </div>

                                <div class="form-field">
                                    <label for="referral_code" class="block text-gray-700 text-sm font-semibold mb-2">
                                        {{ __('Code') }}
                                    </label>
                                    <input type="text" name="referral_code" class="form-input w-full" required>
                                </div>

                                <div class="flex flex-wrap">
                                    <button type="submit"
                                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4">
                                        {{ __('Continue') }}
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </main>
@endsection
