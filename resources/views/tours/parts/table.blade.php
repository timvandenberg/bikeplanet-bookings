@if(isset($bookings))
<table>
    <tr>
        <th>Naam</th>
        <th>Documenten verstuurd</th>
        <th>Heeft betaald</th>
        <th>Ingeschreven op</th>
    </tr>

    @foreach($bookings as $key => $booking)
    @if($isCancelled || $booking->active === 1)
    <tr>
        <td>
            <a class="text-blue-500 font-bold" href="/booking/{{$booking->id}}">
                {{ $booking->name }}
            </a>
        </td>
        <td>
            @if($booking->documents === 1)
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
</table>
@endif
