@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto">
    <div class="w-full sm:px-6 pb-10">

        <div class="bg-gray-100 py-4">
            <a href="@if($user_role === 'admin')/tours/{{ $booking->tour->id }}@else/home @endif" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 ml-6 sm:ml-0">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg mb-4">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <div class="flex justify-between flex-wrap sm:flex-nowrap">
                    <div class="relative w-full sm:w-auto flex flex-wrap sm:block">
                        <div class="w-full mb-2 flex mb-4">
                            <h1 class="text-4xl inline mr-4">
                                Booking - @if($booking->gender === 'male') Mr. @else Miss. @endif
                                {{ $booking->last_name }}, {{ $booking->first_name }}
                            </h1>
                            <div class="flex items-center">
                                <span
                                    class="block w-4 h-4 rounded-full bg-red-500
                                    @if($booking->documents_sent === 1) bg-orange-500 @endif
                                    @if($booking->completed === 1) bg-green-500 @endif"
                                ></span>
                            </div>
                        </div>
                        <div class="w-full mb-2">
                            <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                <span class="font-bold">Tour:</span> <span class="font-normal">{{ $booking->tour->title }} ({{ $booking->tour->season }})</span>
                            </p>
                        </div>
                        <div class="w-full mb-2">
                            <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                <span class="font-bold">Email:</span> <span class="font-normal"><a href="mailto:{{$booking->email}}" class="underline">{{ $booking->email }}</a></span>
                            </p>
                        </div>
                        <div class="w-full mb-2">
                            <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                <span class="font-bold">Phone:</span> <span class="font-normal"><a href="tel:{{$booking->phone}}" class="underline">{{ $booking->phone }}</a></span>
                            </p>
                        </div>
                        <div class="w-full">
                            <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                <span class="font-bold">Registerd on:</span> <span class="font-normal">{{ $booking->created_at }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="relative w-full sm:w-auto mt-4 sm:mt-0">
                        @if($booking->active === 1)
                        <form method="post" action="{{ route('booking.update', $booking) }}">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="update-type" value="cancel_booking">
                            <button type="submit" class="@if($booking->completed === 1) inactive @endif relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 w-full sm:w-auto text-center">
                                Cancel booking
                            </button>
                        </form>
                        @endif

                        @if($booking->active === 0)
                        <form method="post" action="{{ route('booking.destroy', $booking) }}">
                            @csrf
                            <input type="hidden" name="_method" value="delete">

                            <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-red-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-red-500 hover:bg-red-700 w-full sm:w-auto text-center">Delete booking</button>
                        </form>
                        @endif
                    </div>
                </div>
            </header>

            <div class="w-full p-6">
                <h4 class="text-2xl font-semibold">Booking status</h4>
                <div class="w-full flex md:flex-wrap overflow-x-auto md:overflow-visible">
                    <table class="flex-00 whitespace-nowrap styled-table mb-0">
                        <thead>
                            <tr>
                                <th>Documents send</th>
                                <th>Is paying (pp)</th>
                                <th>Discount (%)</th>
                                <th>Has payed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @if($booking->documents_sent === 1)
                                    <span class="text-green-500 font-bold">V</span>
                                    @else
                                    <span class="text-red-500 font-bold">X</span>
                                    @endif
                                </td>
                                <td>{{ $booking->price }}</td>
                                <td>{{ $booking->discount }}</td>
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
                </div>

                <div class="w-full mb-7 pb-7 border-b-2 flex">
                    @if($booking->documents === 0 && $booking->active === 1)
                        <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="update-type" value="create-documents">

                            <div class="inline">

                                <label class="text-gray-700 text-xl font-semibold mb-2 sm:mb-4 mr-2" for="">Price in <span>&euro;</span></label>
                                <input class="form-input" type="number" id="booking-price" name="price" value="{{ $booking->tour->price }}" data-original-price="{{ $booking->tour->price }}">

                                <div class="inline-block my-2 sm:my-0">

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
                                <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700">Create documents</button>
                            </div>
                        </form>
                    @else
                        @if($booking->documents_sent !== 1)
                            <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="update-type" value="create-documents-again">
                                <button type="submit" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 mb-2 sm:mb-0">Change price</button>
                            </form>


                            <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="update-type" value="send-documents">
                                <button
                                        type="submit"
                                        class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 mb-2 sm:mb-0"
                                >
                                    Send Documents
                                </button>
                            </form>
                        @else
                            @if($booking->completed === 1)
                            <p>No more booking actions!</p>
                            @endif
                        @endif
                    @endif

                    @if($booking->completed === 0 && $booking->documents_sent === 1 && $booking->active === 1)
                        <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="update-type" value="has-payed">

                            <button
                                    type="submit"
                                    class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700"
                            >
                                Mark as payed
                            </button>
                        </form>
                    @endif

                </div>

                <div class="w-full mb-7">
                    <h4 class="text-2xl font-semibold">Booking info</h4>
                    <div class="w-full flex md:flex-wrap overflow-x-auto md:overflow-visible">
                        <table class="flex-00 whitespace-nowrap styled-table">
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

                                @if(isset($travelers))
                                @foreach($travelers as $traveler)
                                <tr>
                                    <td>{{ $traveler->first_name }} {{ $traveler->last_name }}</td>
                                    <td>{{ $traveler->bike }}</td>
                                    <td>{{ $traveler->food }}</td>
                                    <td>{{ $traveler->cabin }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($booking->extra_comments)
                <div class="w-full mb-7 py-2 border-t-2">
                    <h3 class="text-2xl font-bold w-full my-4">Extra booking information</h3>
                    <p class="text-md leading-5 text-gray-700">{{$booking->extra_comments}}</p>
                </div>
                @endif

                @if($booking->documents === 1 && $booking->active === 1)
                    <div class="relative py-2 border-t-2">
                        <div class="flex flex-wrap">


                            <div class="relative w-full">
                                <h3 class="text-2xl font-bold w-full my-4">View documents</h3>
                            </div>

                            <div class="relative">
                                <a
                                    href="/pdf/{{ $booking->tour->season }}/{{ $booking->tour->slug }}-{{ $booking->tour->start_date }}/agreement-{{ str_slug($booking->last_name) }}.pdf"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700"
                                >
                                    Agreement
                                </a>

                                <a
                                    href="/pdf/{{ $booking->tour->season }}/{{ $booking->tour->slug }}-{{ $booking->tour->start_date }}/invoice-{{ str_slug($booking->last_name) }}.pdf"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700"
                                >
                                    invoice
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section>

        @if(false && $user_role === 'admin')
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
