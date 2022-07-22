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