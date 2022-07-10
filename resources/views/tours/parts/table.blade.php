<table class="styled-table">
    <thead>
        <tr>
            <th>Last name</th>
            <th>Person Count</th>
            <th>Country</th>
            <th>Registered on</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookings as $key => $booking)
        <tr>
            <td>
                <a class="text-orange-500 font-bold" href="/booking/{{$booking->id}}">
                    {{ $booking->last_name }}
                </a>
            </td>
            <td>{{count($booking->travelers)}}</td>
            <td>{{$booking->country}}</td>
            <td>{{ $booking->created_at }}</td>
            <td>
                <span
                    class="block w-4 h-4 rounded-full bg-red-500
                        @if($booking->documents_sent === 1) bg-orange-500 @endif
                        @if($booking->completed === 1) bg-green-500 @endif"
                ></span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>