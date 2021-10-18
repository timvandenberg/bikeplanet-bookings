@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="text-4xl mb-4 inline mr-4">Thankyou for booking with us!</h1>

            </header>

            <div class="w-full p-6">
                <p class="text-lg inline">
                    Thanks for signing up for {{ $tour->title }}.<br>
                    See below the information we recieved.<br><br>
                    You will recieve further information by Email.</p>
            </div>

            <div class="w-full p-6">
                <h2 class="text-2xl font-semibold mb-2">Booking info</h2>
                <table>
                    @foreach($booking as $key => $row)
                    @if($key !== '_token' && $key !== 'tour_id' && $key !== 'input_total_person_count')
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$row}}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </div>

            <div class="w-full p-6">
                <h2 class="text-2xl font-semibold mb-2">Travelers</h2>
                <table>
                    @foreach($travelers as $key => $row)
                    <tr>
                        <td>{{$row->first_name}}</td>
                        <td>{{$row->last_name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->bike}}</td>
                        <td>{{$row->food}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </div>
</main>
@endsection
