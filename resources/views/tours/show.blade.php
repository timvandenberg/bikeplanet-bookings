@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto">
    <div class="w-full sm:px-6">

        <div class="bg-gray-100 py-4">
            <a href="/home" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <div class="flex justify-between">
                    <div class="relative">
                        <div class="mb-4">
                            <h1 class="inline text-4xl mr-2">{{$tour->title}}</h1>
                            <h2 class="inline text-2xl mr-2"> ( {{$tour->season}} )</h2>
                            <a class="inline font-normal text-sm" href="http://bikeplanet-bookings.test/booking/new/{{ $tour->season }}/{{ $tour->slug }}" target="_blank" rel="noopener noreferrer">
                                [ Form link ]
                            </a>
                        </div>

                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">Start date:</span> <span class="font-normal">{{ $tour->start_datetime }}</span>
                                </p>
                            </div>

                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">End date:</span> <span class="font-normal">{{ $tour->end_datetime }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">From:</span> <span class="font-normal">{{ $tour->start_location }}</span>
                                </p>
                            </div>

                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">To:</span> <span class="font-normal">{{ $tour->end_location }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">Price:</span> <span class="font-normal">{{ $tour->price }}</span>
                                </p>
                            </div>
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">Max bookings:</span> <span class="font-normal">{{ $tour->max_bookings }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">Crew:</span> <span class="font-normal">{{ $tour->crew }}</span>
                                </p>
                        </div>
                            <div class="w-1/2">
                                <p>
                                    <span class="font-bold">Guides:</span> <span class="font-normal">{{ $tour->guides }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="relative inline">
                        <a href="{{ route('tours.edit', $tour->id) }}" class="relative inline-block w-auto select-none font-bold whitespace-no-wrap px-6 py-2 border-blue-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">Edit tour</a>
                    </div>
                </div>
            </header>

            <div class="w-full p-6">
                @if(isset($bookings))
                <p class="text-xl font-bold w-full mb-2">Actieve bookingen</p>

                <?php $isCancelled = false; ?>
                @include('tours.parts.table')
                @endif
            </div>

            @if(isset($cancelled) && count($cancelled) !== 0)
            <div class="w-full p-6">
                <p class="text-xl font-bold w-full mb-2">Geannuleerde bookingen</p>

                <?php
                $isCancelled = true;
                $bookings = $cancelled;
                ?>
                @include('tours.parts.table')
            </div>
            @endif
        </section>
    </div>
</main>
@endsection