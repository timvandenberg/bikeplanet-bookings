@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="bg-gray-200 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <h1 class="text-4xl font-bold text-gray-700 mb-2">
                    Welcome {{ $person->name }}
                </h1>

                <p>This is your dashboard</p>
            </header>

            <div class="w-full p-6">
                <p class="text-xl font-bold mb-2">My bookings</p>

                <table>
                    <tr>
                        <th>Title</th>
                        <th>Season</th>
                        <th>Documents recieved</th>
                        <th>Has payed</th>
                        <th>Booked on</th>
                    </tr>

                    @foreach($bookings as $key => $booking)
                    <tr>
                        <td>
                            <a class="text-orange-500 font-bold" href="/booking/{{$booking->id}}">
                                {{ $booking->tour->title }}
                            </a>
                        </td>
                        <td>{{ $booking->tour->season }}</td>
                        <td>
                            @if($booking->documents === 1)
                            <span class="text-green-500 font-bold">V</span>
                            @else
                            <span class="text-red-500 font-bold">X</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->completed === 1)
                            <span class="text-green-500 font-bold">V</span>
                            @else
                            <span class="text-red-500 font-bold">X</span>
                            @endif
                        </td>
                        <td>{{ $booking->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </div>
</main>
@endsection
