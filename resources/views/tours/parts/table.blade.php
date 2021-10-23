@if(isset($bookings))
<table class="styled-table">
    <thead>
        <tr>
            <th>Last name</th>
            <th>Documents sent</th>
            <th>Is payed</th>
            <th>Ingeschreven op</th>
        </tr>
    </thead>

    <tbody>
    @foreach($bookings as $key => $booking)
        @if($isCancelled || $booking->active === 1)
            <tr>
                <td>
                    <a class="text-orange-500 font-bold" href="/booking/{{$booking->id}}">
                        {{ $booking->last_name }}
                    </a>
                </td>
                <td>
                    @if($booking->documents_sent === 1)
                    <span class="text-green-500 font-bold">V</span>
                    @else
                    <span class="text-red-500 font-bold">X</span>
                    @endif
                </td>
                <td>
                    @if($booking->completed === 1)
                    <span class="text-green-500 font-bold">V</span>
                    @else
                    <span class="text-red-500 font-bold">X</span>
                    @endif
                </td>
                <td>{{ $booking->created_at }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
@endif
