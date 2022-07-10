<header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:rounded-t-md">
    <div class="flex justify-between flex-wrap sm:flex-nowrap">
        <div class="relative w-full sm:w-auto flex flex-wrap sm:block">
            <div class="w-full mb-2 flex mb-4">
                <h1 class="text-2xl md:text-4xl inline mr-4">
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
            <div class="w-full">
                <p class="text-sm sm:text-md inline w-full sm:w-auto sm:mt-0">
                    <span class="bold">Tour:</span> <span class="font-normal">{{ $booking->tour->title }} ({{ $booking->tour->season }})</span>
                </p>
            </div>
            <div class="w-full">
                <p class="text-sm sm:text-md inline w-full sm:w-auto sm:mt-0">
                    <span class="bold">Email:</span> <span class="font-normal"><a href="mailto:{{$booking->email}}" class="underline">{{ $booking->email }}</a></span>
                </p>
            </div>
            <div class="w-full">
                <p class="text-sm sm:text-md inline w-full sm:w-auto sm:mt-0">
                    <span class="bold">Phone:</span> <span class="font-normal"><a href="tel:{{$booking->phone}}" class="underline">{{ $booking->phone }}</a></span>
                </p>
            </div>
            <div class="w-full">
                <p class="text-sm sm:text-md inline w-full sm:w-auto sm:mt-0">
                    <span class="bold">Registerd on:</span> <span class="font-normal">{{ $booking->created_at }}</span>
                </p>
            </div>
        </div>
        <div class="relative w-full sm:w-auto mt-4 sm:mt-0">
            @if($booking->active === 1)
                <form method="post" action="{{ route('booking.update', $booking) }}">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="update-type" value="cancel_booking">
                    <button type="submit" class="@if($booking->completed === 1) inactive @endif relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:w-auto text-center">
                        Cancel booking
                    </button>
                </form>
            @endif

            @if($booking->active === 0)
                <div class="flex">
                    <div class="pr-2">
                        <form method="post" action="{{ route('booking.update', $booking) }}">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="update-type" value="activate_booking">
                            <button type="submit" class="@if($booking->completed === 1) inactive @endif relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 hover:bg-orange-700 sm:w-auto text-center">
                                Activate booking
                            </button>
                        </form>
                    </div>
                    <form method="post" action="{{ route('booking.destroy', $booking) }}">
                        @csrf
                        <input type="hidden" name="_method" value="delete">

                        <button type="submit" class="relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-red-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-red-500 hover:bg-red-700 w-full sm:w-auto text-center">Delete booking</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</header>