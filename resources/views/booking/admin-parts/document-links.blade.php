<div class="relative py-2 border-t-2">
    <div class="flex flex-wrap">


        <div class="relative w-full">
            <h3 class="text-xl sm:text-2xl bold w-full my-4">Documents</h3>
        </div>

        <div class="relative flex">
            <form method="post" action="{{ route('booking.documents', $booking->id) }}" class="pr-2">
                @csrf
                <input name="type" type="hidden" value="agreement">
                <button
                        type="submit"
                        class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1
                    sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
                >
                    Agreement
                </button>
            </form>

            <form method="post" action="{{ route('booking.documents', $booking->id) }}">
                @csrf
                <input name="type" type="hidden" value="invoice">
                <button
                    type="submit"
                    class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1
                    sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
                >
                    invoice
                </button>
            </form>
        </div>
    </div>
</div>