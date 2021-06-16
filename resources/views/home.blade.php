@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-12">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex mt-4 flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <div class="flex justify-between">
                    <div class="titlebox">
                        <h1 class="text-4xl inline mr-2">Dashboard</h1>
                        <select name="season" id="select-season" class="text-xl font-bold inline form-input">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>

                    <div class="relative">
                        <a href="/tours/create" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700">Nieuwe Tour</a>
                    </div>
                </div>
            </header>

            <div class="w-full p-6 flex">
                @if(isset($tours))
                <table>
                    <thead>
                        <tr>
                            <th class="text-lg">Tour title</th>
                            <th class="text-lg">Pending</th>
                            <th class="text-lg">Booked</th>
                            <th class="text-lg">Plekken over</th>
                        </tr>
                    </thead>
                    @foreach($tours as $key => $tour)
                    <tr class="season-row season-{{ $tour['season'] }}" <?php if(date("Y") != $tour['season']) { echo 'style="display: none"'; }?>>
                        <td><a href="/tours/{{ $tour['id'] }}" class="text-orange-500 font-bold">{{ $tour['title'] }}</a></td>
                        <td>{{ $tour['pending'] }}</td>
                        <td>{{ $tour['completed'] }}</td>
                        <td>{{ $tour['spots_left'] }}</td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
        </section>
    </div>
</main>
@endsection
