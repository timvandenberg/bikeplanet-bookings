@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="text-2xl sm:text-4xl mb-4 inline mr-4">Thankyou for booking with us!</h1>
            </header>

            <div class="w-full p-6">
                <p class="text-md sm:text-lg inline leading-6">
                    You signed up for <span class="bold">{{ $tour->title }}</span>!<br>
                    See below some of information we recieved.<br><br>
                    You will recieve further <span class="bold">information by Email</span>.
                </p>
            </div>

            <div class="w-full p-6">
                <h2 class="text-xl sm:text-2xl bold mb-2">Booking contact info</h2>
                <table class="styled-table">
                    @foreach($booking as $key => $row)
                    @php
                    $keyObj = [
                        'first_name' => 'First name',
                        'last_name' => 'Last name',
                        'birth_date' => 'date of Birth',
                        'email' => 'Email',
                        'phone' => 'Phone',
                        'street' => 'Street',
                        'postal_code' => 'Postal code',
                        'town' => 'Town',
                        'country' => 'Country'
                    ]
                    @endphp
                    @if($key !== '_token' && $key !== 'tour_id' && $key !== 'input_total_person_count' && $key !== 'gender')
                    <tr>
                        <td>{{$keyObj[$key]}}</td>
                        <td>{{$row}}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </div>

            @if($travelers)
            <div class="w-full p-6 overflow-x-scroll">
                <h2 class="text-xl sm:text-2xl bold mb-2">Including travelers:</h2>
                <table class="styled-table">
                    @foreach($travelers as $key => $row)
                    <tr>
                        <td>{{$row->first_name}}</td>
                        <td>{{$row->last_name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->bike}}</td>
                        <td>{{$row->diet}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif
        </section>
    </div>
</main>
@endsection
