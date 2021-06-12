@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto">
    <div class="w-full sm:px-6">

        <div class="bg-gray-100 py-4">
            <a href="@if($user_role === 'admin')/tours/{{ $booking->tour->id }}@else/home @endif" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <div class="flex justify-between">
                    <div class="relative">

                        <h1 class="text-4xl mb-4 inline mr-4">Booking - {{ $booking->name }}</h1>
                        <p class="text-lg inline">
                            <span class="font-bold">Tour:</span> <span class="font-normal">{{ $booking->tour->title }}</span> | <span class="font-bold">Season:</span> <span class="font-normal">{{ $booking->tour->season }}</span>
                        </p>
                    </div>
                    <div class="relative">
                        @if($booking->active === 1)
                        <form method="post" action="{{ route('booking.update', $booking) }}">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="update-type" value="cancel_booking">
                            <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Annuleer booking</button>
                        </form>
                        @endif

                        @if($booking->active === 0)
                        <form method="post" action="{{ route('booking.destroy', $booking) }}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">

                            <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-red-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-red-500 hover:bg-red-700">Verwijder booking</button>
                        </form>
                        @endif
                    </div>
                </div>
            </header>

            <div class="w-full p-6">
                <h4 class="text-2xl font-semibold mb-4">Booking status</h4>
                <table class="mb-8">
                    <thead>
                        <tr>
                            <th>Documents</th>
                            <th>Is paying</th>
                            <th>Has payed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @if($booking->documents === 1)
                                <span class="text-green-500 font-bold">V</span>
                                @else
                                <span class="text-red-500 font-bold">X</span>
                                @endif
                            </td>
                            <td>{{ $booking->price }}</td>
                            <td>
                                @if($booking->completed === 1)
                                <span class="text-green-500 font-bold">V</span>
                                @else
                                <span class="text-red-500 font-bold">X</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="text-2xl font-semibold mb-4">Booking info</h4>
                <table class="mb-8">
                    <thead>
                        <tr>
                            <th>Person</th>
                            <th>Bike</th>
                            <th>Food</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
{{--                         <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->bike }}</td>
                            <td>{{ $booking->food }}</td>
                            <td>{{ $booking->room }}</td>
                        </tr> --}}

                        @if(isset($persons))
                        @foreach($persons as $person)
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->bike }}</td>
                            <td>{{ $person->food }}</td>
                            <td>{{ $person->room }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                @if($user_role === 'admin')
                    <div class="relative border-t-2 pt-8">
                        <p class="text-4xl font-bold w-full mb-4">Invoice</p>
                        <div class="flex justify-between">
                            @if($booking->documents === 0 && $booking->active === 1)
                            <form method="post" action="{{ route('booking.update', $booking) }}">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="update-type" value="send-documents">

                                <div class="inline">

                                    <label class="text-gray-700 text-xl font-semibold mb-2 sm:mb-4 mr-2" for="">Prijs in <span>&euro;</span></label>
                                    <input class="form-input" type="number" id="booking-price" name="price" value="{{ $booking->tour->price }}" data-original-price="{{ $booking->tour->price }}">

                                    <div class="inline-block">

                                        <div class="flex column">
                                            <label class="radio-container relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 mx-1 cursor-pointer">
                                                15%
                                              <input class="discount-radio opacity-0 absolute inset-0" type="radio" name="discount" value="15">
                                            </label>

                                            <label class="radio-container relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 mx-1 cursor-pointer">
                                                30%
                                              <input class="discount-radio opacity-0 absolute inset-0" type="radio" name="discount" value="30">
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Send documenten</button>
                                </div>
                            </form>
                            @else
                            <form method="post" action="{{ route('booking.update', $booking) }}">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="update-type" value="send-documents-again">
                                <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Change price and send again</button>
                            </form>
                            @endif

                            @if($booking->completed === 0 && $booking->documents === 1 && $booking->active === 1)
                            <form method="post" action="{{ route('booking.update', $booking) }}">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="update-type" value="has-payed">

                                <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Mark as payed</button>
                            </form>
                            @endif

                            @if($booking->documents === 1 && $booking->active === 1)
                            <div class="relative">
                                <a href="/pdf/{{ $booking->tour->season }}/{{ $booking->tour->slug }}-{{$titleSlug}}.pdf" target="_blank" rel="noopener noreferrer" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-green-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-green-500 hover:bg-green-700">See invoice</a>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </section>

        @if($user_role === 'admin')
        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg mt-10">
            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <div class="flex justify-between">
                    <div class="relative">
                        <h1 class="text-2xl inline">Booking actions</h1>
                    </div>
                </div>
            </header>
            <div class="w-full p-6">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Actie</th>
                            <th>Datum</th>
                            <th>Who</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endif

    </div>
</main>
@endsection
