<div class="relative py-2 border-t-2">
    <div class="flex flex-wrap">


        <div class="relative w-full">
            <h3 class="text-xl sm:text-2xl bold w-full my-4">Documents</h3>
        </div>

        <div class="relative">
            <a
                    href="/pdf/{{ $booking->tour->season }}/{{ $booking->tour->slug }}-{{ $booking->tour->start_date }}/agreement-{{ str_slug($booking->last_name) }}.pdf"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
            >
                Agreement
            </a>

            <a
                    href="/pdf/{{ $booking->tour->season }}/{{ $booking->tour->slug }}-{{ $booking->tour->start_date }}/invoice-{{ str_slug($booking->last_name) }}.pdf"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn-primary relative inline-block w-auto select-none bold whitespace-no-wrap px-4 sm:px-6 py-1 sm:py-2 border-orange-500 border rounded-lg text-base leading-normal no-underline text-gray-100 bg-orange-500 text-center"
            >
                invoice
            </a>
        </div>
    </div>
</div>