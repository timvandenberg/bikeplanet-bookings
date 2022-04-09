@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto">
    <div class="w-full sm:px-6 pb-10">

        <div class="bg-gray-100 py-4">
            <a href="/home" class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center ml-6 sm:ml-0">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                <div class="flex justify-between flex-wrap">
                    <div class="relative w-full sm:w-auto">
                        <div class="mb-4">
                            <div class="flex">
                                <h1 class="inline text-4xl mr-2">{{$tour->title}}</h1>
                                <h2 class="inline text-4xl mr-2"> ( {{$tour->season}} )</h2>
                                <div class="inline">
                                    <a
                                        class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
                                        href="http://{{$_SERVER['HTTP_HOST']}}/new-booking/{{ $tour->season }}/{{ $tour->slug }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Apply form
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">Start date:</span> <span class="font-normal">{{ $tour->start_date }}</span>
                                </p>
                            </div>

                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">End date:</span> <span class="font-normal">{{ $tour->end_date }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">From:</span> <span class="font-normal">{{ $tour->start_location }}</span>
                                </p>
                            </div>

                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">To:</span> <span class="font-normal">{{ $tour->end_location }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">Price:</span> <span class="font-normal">{{ $tour->price }}</span>
                                </p>
                            </div>
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">Max bookings:</span> <span class="font-normal">{{ $tour->max_bookings }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">Crew:</span> <span class="font-normal">{{ $tour->crew }}</span>
                                </p>
                        </div>
                            <div class="w-full sm:w-1/2">
                                <p>
                                    <span class="bold">Guides:</span> <span class="font-normal">{{ $tour->guides }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="relative inline w-full sm:w-auto mt-4 sm:mt-0">
                        <a
                            href="{{ route('tours.edit', $tour->id) }}"
                            class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
                        >
                            Edit tour
                        </a>
                    </div>
                </div>
            </header>

            @if(isset($bookings))
            <div class="w-full flex justify-between p-6 pb-0">
                <div class="flex items-end">
                    <p class="text-xl bold w-full">Active Bookings</p>
                </div>
{{--                <a href="{{ route('tours.export', $tour->id) }}" class="inactive relative inline-block w-auto select-none bold whitespace-no-wrap px-6 py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center">Export Guest list</a>--}}
            </div>
            <div class="w-full p-6 pt-0 flex md:flex-wrap overflow-x-auto md:overflow-visible">
                <?php $isCancelled = false; ?>

                <livewire:bookings-table :tourID="$tour->id"/>
{{--                @include('tours.parts.table')--}}
            </div>
            @endif

            @if(isset($cancelled) && count($cancelled) !== 0)
            <div class="w-full p-6">
                <p class="text-xl bold w-full mb-2">Cancelled bookings</p>

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
