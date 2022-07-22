<section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
    <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
        <div class="flex justify-between">
            <div class="relative">
                <h3 class="text-xl sm:text-2xl inline">Booking history</h3>
            </div>
        </div>
    </header>
    <div class="w-full p-6 py-0 sm:py-6">
        <table class="w-full flex-00 whitespace-nowrap styled-table mt-0">
            <thead>
            <tr>
                <th>Actie</th>
                <th>Date</th>
                <th>Who</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($bookingActions))
                @foreach($bookingActions as $ba)
                    <tr>
                        <td>{{ $ba->action }} </td>
                        <td>{{ $ba->date->format('d-m-Y') }} </td>
                        <td>{{ $ba->who }} </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</section>