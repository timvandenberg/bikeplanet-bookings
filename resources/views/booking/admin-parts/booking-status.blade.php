<div class="w-full flex md:flex-wrap overflow-x-auto md:overflow-visible">
    <table class="flex-00 whitespace-nowrap styled-table mb-0">
        <thead>
        <tr>
            <th>Documents send</th>
            <th>Is paying</th>
            <th>Voucher discount (in &euro;)</th>
            <th>Has payed</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                @if($booking->documents_sent === 1)
                    <span class="text-green-500 bold">V</span>
                @else
                    <span class="text-red-500 bold">X</span>
                @endif
            </td>
            <td>{{ $booking->price }}</td>
            <td>{{ $booking->discount }}</td>
            <td>
                @if($booking->completed === 1)
                    <span class="text-green-500 bold">V</span>
                @else
                    <span class="text-red-500 bold">X</span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>