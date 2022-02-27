<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style type="text/css" media="all">
        * {
            margin: 0;
            padding: 0;
        }
        div  {
            display: block;
        }
        body {
            padding: 30px;
        }
        .header {
            position: relative;
            height: 200px;
            width: 100%;
            padding-top: 150px;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 800px;
            height: 1125px;
        }
        .full {
            clear: both;
            margin: 0 0 20px 0;
        }
        .textfield {
            position: relative;
            margin-bottom: 20px;
        }
        .bold {
            font-weight: 700;
        }
        table {
            margin-top: 10px;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid #999;
            padding: 5px 10px;
            text-align: left;
        }
        td.blank {
            border-left: 1px solid transparent;
            border-bottom: 1px solid transparent;
        }
        ul {
            margin-top: 10px;
            position: relative;
            padding-left: 20px;
            list-style-type: disc;
        }
    </style>
</head>

@php
    $travelerCount = count($travelers);
    $bookingPrice = $travelerCount*$tour->price;
    $finalPrice = $bookingPrice;
    $subTotal = $finalPrice;
    $bikePrice = 0;
    $eBikeCount = 0;
    foreach($travelers as $traveler) {
        if($traveler->bike === 'e-bike') {
            $bikePrice += 100;
            $eBikeCount += 1;
        }
    }
    $subTotal += $bikePrice;
    $finalPrice += $bikePrice;

    if($booking->discount) {
         $finalPrice -= (int)$booking->discount;
    }
    $allNames = [];
    $cabins = [];
@endphp
@foreach ($travelers as $traveler)
    @php
        $allNames[] = $traveler->first_name .' '. $traveler->last_name;
        if (!in_array($traveler->cabin, $cabins)) {
          $cabins[] = $traveler->cabin;
        }
    @endphp
@endforeach

<body>
    <img class="logo" src="{{ asset('img/agreement-background.jpeg') }}" alt="">

    <div class="full header">
        <div class="textfield">
            <p class="bold">
                {{ implode(', ', $allNames) }}
            </p>
            <p class="bold">{{ $booking->street }}, {{ $booking->postal_code }}, {{ $booking->town }}</p>
            <p class="bold">{{ $booking->country }}</p>
        </div>
        <div class="textfield">
            <p class="bold">AGREEMENT</p>
        </div>
        <div class="textfield">
            <p class="bold">A-BPT-2022-Danube-{{ date('d') }}-{{ $booking->last_name }}</p>
        </div>
        <div class="textfield">
            <p>Herewith <span class="bold">BikePlanet Tours BV</span>, represented by Lenny Versteeg, hereinafter to be
                referred to as <span class="bold">“Travel Organizer”</span>, confirms the following agreement between
                Travel Organizer and {{ implode(', ', $allNames) }},
                hereinafter referred to as the “Travelers”; The Travel Organizer shall provide to the Travelers a
                Bike-and-Cruise Tour on the Danube, starting in Passau, visiting Budapest, ending in Passau.
                The number of travelers is {{ $travelerCount }} in a {{  implode(', ', $cabins) }} Cabin.
            </p>
        </div>
        <div class="textfield">
            <p>The Tour shall begin in <span class="bold">Passau (Germany) on {{ $tour->start_date }}</span>.
                Embarkation starts at around 4 PM.
            </p>
            <p>The Tour shall end on the <span class="bold">{{ $tour->end_date }}</span> until 10 am.</p>
        </div>
        <div class="textfield">
            <p>The total price for this tour is:</p>
            <table>
                <thead>
                <tr>
                    <th>Travelers</th>
                    <th>Type</th>
                    <td>Total</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $travelerCount }}</td>
                    <td>
                        Cabin (&euro; {{ $tour->price }} )
                    </td>
                    <td>&euro; {{ $bookingPrice }}</td>
                </tr>
                @if($eBikeCount !== 0)
                <tr>
                    <td>{{ $eBikeCount }}</td>
                    <td>E-bike reservation (&euro; 100)</td>
                    <td>&euro; {{ $bikePrice }}</td>
                </tr>
                @endif
                @if($booking->discount)
                <tr>
                    <td class="blank"></td>
                    <td class="bold">Subtotal</td>
                    <td class="bold">&euro; {{ $subTotal }}</td>
                </tr>
                <tr>
                    <td class="blank"></td>
                    <td>Voucher-Discount</td>
                    <td>&euro; {{ $booking->discount }}</td>
                </tr>
                @endif
                <tr>
                    <td class="blank"></td>
                    <td class="bold">Total</td>
                    <td class="bold">&euro; {{ $finalPrice }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="textfield">
            <p>
                Service included and calculated for this reservation: On this tour, offered by BikePlanet Tours on the
                PRIMADONNA, the following is included:
            </p>
            <ul>
                <li>Cabin(s) on the {{  implode(', ', $cabins) }}</li>
                <li>7 Days of Sailing, Breakfast Buffets, Lunch/Packed Lunch and Dinners on PRIMADONNA</li>
                <li>Daily afternoon tea, when on board</li>
                <li>BikePlanet Tour guides + GPS dates and maps</li>
                <li>Sightseeing tours in Vienna, Bratislava and Budapest</li>
                <li>Regular bike(s) with 21 gears including insurance or E-bike upgrade (see above)</li>
                <li>Pannier(s), water bottle(s) and helmet(s)</li>
            </ul>
        </div>
        <div class="textfield">
            <p>Please understand that schedule/program changes due to regional circumstances
                (eg. flood, low water, bad weather, malfunctioning locks etc.) can be possible on order of the 1th captain.
                Conditions of payment of the agreed price by travelers as stated in the invoices.
                <i>The General Terms and Conditions of BikePlanet Tours are applicable to this agreement.</i>
            </p>
        </div>
    </div>
</body>
</html>


