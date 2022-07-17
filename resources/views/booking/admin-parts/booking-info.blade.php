<div class="w-full mb-7">
    <h4 class="text-xl sm:text-2xl bold">Travelers info</h4>
    <div class="w-full flex md:flex-wrap overflow-x-auto md:overflow-visible">
        <table class="flex-00 whitespace-nowrap styled-table">
            <thead>
            <tr>
                <th>Person</th>
                <th>Bike</th>
                <th>Diet</th>
                <th>Room</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($travelers))
                @foreach($travelers as $traveler)
                    <tr>
                        <td>{{ $traveler->first_name }} {{ $traveler->last_name }}</td>
                        <td>{{ $traveler->bike }}</td>
                        <td>{{ $traveler->diet }}</td>
                        <td>{{ $traveler->cabin }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>