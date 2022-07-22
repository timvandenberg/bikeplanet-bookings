@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full m-auto md:max-w-4xl sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="flex justify-between flex-wrap sm:no-wrap bg-gray-200 py-5 px-6 sm:py-6 sm:rounded-t-md">
                <h1 class="w-full sm:w-2/3 text-2xl sm:text-4xl font-semibold mb-2 text-gray-700">
                    Remarks
                </h1>
                <div class="w-full sm:w-1/3 flex justify-end items-start">
                    <div class="flex flex-col justify-end">
                        <h3 class="text-sm sm:text-md font-semibold mb-2 pt-2 text-gray-700">
                            page 4 of 4
                        </h3>
                    </div>
                </div>
            </header>

            <div class="w-full p-6">
                <h2 class="text-xl sm:text-2xl bold mb-4 text-gray-700 pr-2">Do you have any additional information you want to share?</h2>
                <form class="" method="POST" action="{{ route('booking.store') }}">
                    @csrf

                    <textarea class="form-input w-full mb-4" name="extra_comments" id="" cols="30" rows="5"></textarea>
                    <button
                        type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal
                        no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:py-4"
                    >
                        {{ __('Book now') }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
