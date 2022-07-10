<header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
    <div class="flex justify-between flex-wrap">
        <div class="relative w-full sm:w-auto">
            <div class="mb-4">
                <div class="flex">
                    <h1 class="inline text-3xl md:text-4xl mr-2">{{$tour->title}} ( {{$tour->season}} )</h1>

                </div>
                <div class="flex mt-4">
                    <a
                        class="text-orange-500 bold"
                        href="http://{{$_SERVER['HTTP_HOST']}}/new-booking/{{ $tour->season }}/{{ $tour->slug }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Application form url
                    </a>
                    <span class="transform -translate-y-1 translate-x-1 scale-75">
                                    <svg fill="#F19C26" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 5 3 C 3.9069372 3 3 3.9069372 3 5 L 3 19 C 3 20.093063 3.9069372 21 5 21 L 19 21 C 20.093063 21 21 20.093063 21 19 L 21 12 L 19 12 L 19 19 L 5 19 L 5 5 L 12 5 L 12 3 L 5 3 z M 14 3 L 14 5 L 17.585938 5 L 8.2929688 14.292969 L 9.7070312 15.707031 L 19 6.4140625 L 19 10 L 21 10 L 21 3 L 14 3 z"/></svg>
                                </span>
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
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/2">
                    <p>
                        <span class="bold">Referral Code:</span> <span class="font-normal">{{ $tour->referral_code }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="relative inline w-full sm:w-auto mt-4 sm:mt-0">
            <a
                href="{{ route('tours.edit', $tour->id) }}"
                class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
            >
                Edit tour
            </a>
        </div>
    </div>
</header>