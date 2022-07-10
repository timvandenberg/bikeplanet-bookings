@extends('layouts.app')

@section('content')
<main class="bike-container sm:mx-auto">
    <div class="w-full sm:px-6 pb-10">

        <div class="bg-gray-100 py-4">
            <a href="/home" class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center ml-6 sm:ml-0">Back</a>
        </div>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            @include('tours.admin-parts.header')

            @if(isset($bookings))
            <div class="w-full flex justify-between p-6 pb-0">
                <div class="flex items-end">
                    <p class="text-xl bold w-full">Active Bookings</p>
                </div>
            </div>
            <div class="w-full p-6 pt-0 flex md:flex-wrap overflow-x-auto md:overflow-visible">
                <livewire:bookings-table :tourID="$tour->id"/>
            </div>
            @endif

            @if(isset($cancelled) && count($cancelled) !== 0)
            <div class="w-full p-6 ">
                <p class="text-xl bold w-full mb-2">Cancelled bookings</p>

                <div class="w-full overflow-x-auto md:overflow-visible">
                    @php ( $bookings = $cancelled )
                    @include('tours.parts.table')
                </div>
            </div>
            @endif
        </section>
    </div>
</main>
@endsection
