<div class="w-full mb-7 pb-7 border-b-2 flex">
    @if($booking->active === 1)
        @if($booking->documents === 0)
            <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1 w-full">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="update-type" value="create-documents">

                <div class="w-full mb-2">
                    <label class="text-gray-700 text-xl font-semibold mb-2 sm:mb-4 mr-2" for="">
                        Price (original): <span>&euro;</span> {{ $booking->tour->price }}
                    </label>
                </div>
                <div class="w-full">
                    <p class="inline text-gray-700 text-xl font-semibold">Voucher discount: <span>&euro;</span></p>
                    <input
                            class="form-input text-gray-700 text-xl font-semibold w-20"
                            type="number"
                            name="discount"
                            value="{{ $booking->discount }}"
                    >
                    <button
                            type="submit"
                            class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6
                                        py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline
                                        text-gray-100 bg-orange-500 hover:bg-orange-700"
                    >
                        Create documents
                    </button>
                </div>
            </form>
        @else
            @if($booking->documents_sent !== 1)
                <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="update-type" value="create-documents-again">
                    <button
                            type="submit"
                            class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6
                                        py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline
                                        text-gray-100 bg-orange-500 hover:bg-orange-700 mb-2 sm:mb-0"
                    >
                        Change price
                    </button>
                </form>


                <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="update-type" value="send-documents">
                    <button
                            type="submit"
                            class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6
                                        py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline
                                        text-gray-100 bg-orange-500 hover:bg-orange-700 mb-2 sm:mb-0"
                    >
                        Send Documents
                    </button>
                </form>
            @else
                @if($booking->completed === 1)
                    <p>No more booking actions!</p>
                @endif
            @endif
        @endif
    @endif

    @if($booking->completed === 0 && $booking->documents_sent === 1 && $booking->active === 1)
        <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
            @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="update-type" value="has-payed">

            <button
                    type="submit"
                    class="relative inline-block w-auto select-none bold whitespace-no-wrap
                                    px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline
                                    text-gray-100 bg-orange-500 hover:bg-orange-700"
            >
                Mark as payed
            </button>
        </form>

        <form method="post" action="{{ route('booking.update', $booking) }}" class="mr-1">
            @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="update-type" value="send-reminder-documents">
            <button
                    type="submit"
                    class="relative inline-block w-auto select-none bold whitespace-no-wrap px-6
                                py-2 border-purple-500 border rounded-lg text-base leading-normal no-underline
                                text-gray-100 bg-purple-500 hover:bg-purple-700 mb-2 sm:mb-0"
            >
                Send reminder mail with documents
            </button>
        </form>
    @endif

</div>