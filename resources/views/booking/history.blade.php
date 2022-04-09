@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto">
        <div class="w-full sm:px-6 pb-10">

            <div class="bg-gray-100 py-4">
                <a href="/tours/{{ $booking->tour->id }}" class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 ml-6 sm:ml-0">Back</a>
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
                                    <span class= bold">Tour:</span> <span class="font-normal">{{ $booking->tour->title }} ({{ $booking->tour->season }})</span>
                                </p>
                            </div>
                            <div class="w-full mb-2">
                                <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                    <span class= bold">Email:</span> <span class="font-normal"><a href="mailto:{{$booking->email}}" class="underline">{{ $booking->email }}</a></span>
                                </p>
                            </div>
                            <div class="w-full mb-2">
                                <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                    <span class= bold">Phone:</span> <span class="font-normal"><a href="tel:{{$booking->phone}}" class="underline">{{ $booking->phone }}</a></span>
                                </p>
                            </div>
                            <div class="w-full">
                                <p class="text-md inline w-full sm:w-auto sm:mt-0">
                                    <span class= bold">Registerd on:</span> <span class="font-normal">{{ $booking->created_at }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="relative w-full sm:w-auto mt-4 sm:mt-0">
                            @if($booking->active === 1)
                                <form method="post" action="{{ route('booking.update', $booking) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="update-type" value="cancel_booking">
                                    <button type="submit" class="@if($booking->completed === 1) inactive @endif relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 w-full sm:w-auto text-center">
                                        Cancel booking
                                    </button>
                                </form>
                            @endif

                            @if($booking->active === 0)
                                <form method="post" action="{{ route('booking.destroy', $booking) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">

                                    <button type="submit" class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-red-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-red-500 hover:bg-red-700 w-full sm:w-auto text-center">Delete booking</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </header>

            </section>

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg mt-10">
                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    <div class="flex justify-between">
                        <div class="relative">
                            <h1 class="text-2xl inline">History</h1>
                        </div>
                    </div>
                </header>
                <div class="w-full p-6">
                    <table class="w-full flex-00 whitespace-nowrap styled-table">
                        <thead>
                        <tr>
                            <th>Actie</th>
                            <th>Datum</th>
                            <th>Who</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($bookingActions))
                            @foreach($bookingActions as $ba)
                                <tr>
                                    <td>{{ $ba->action }} </td>
                                    <td>{{ $ba->date }} </td>
                                    <td>{{ $ba->who }} </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
@endsection
