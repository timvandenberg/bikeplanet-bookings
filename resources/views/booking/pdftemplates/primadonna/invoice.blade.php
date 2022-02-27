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
    $bikePrice = 0;
    $eBikeCount = 0;
    foreach($travelers as $traveler) {
        if($traveler->bike === 'e-bike') {
            $bikePrice += 100;
            $eBikeCount += 1;
        }
    }
    $finalPrice += $bikePrice;

    $allNames = [];
@endphp
@foreach ($travelers as $traveler)
    @php
        $allNames[] = $traveler->first_name .' '. $traveler->last_name;
    @endphp
@endforeach

<body>
<img class="logo" src="{{ asset('img/agreement-background.jpeg') }}" alt="">

<div class="full header">
    <div class="textfield">
        <p class="bold">
            {{ $booking->first_name }} {{ $booking->last_name }}
        </p>
        <p class="bold">{{ $booking->street }}, {{ $booking->postal_code }}, {{ $booking->town }}</p>
        <p class="bold">{{ $booking->country }}</p>
    </div>
    <div class="textfield">
        <p class="bold">RESERVATION NR: I-BPT-{{ $tour->star_date }}-Danube-{{ $booking->last_name }}</p>
        <p>Schellinkhout, {{ date('d m Y') }}</p>
    </div>
    <div class="textfield">
        <p>BikePlanet Tour: Danube 2022</p>
        <p>Date of arrival: {{ $tour->star_date }}</p>
        <p>Date of departure: {{ $tour->end_date }}</p>
        <p>Guests: {{ implode(', ', $allNames) }}</p>
    </div>
    <div class="textfield">
        <table>
            <tbody>
                <tr>
                    <td>
                        Total tour costs
                    </td>
                    <td>&euro; {{ $finalPrice }}</td>
                </tr>
                @if($booking->discount)
                <tr>
                    <td>Voucher-Discount</td>
                    <td>&euro; {{$booking->discount}}</td>
                </tr>
                @php
                if($booking->discount) {
                     $finalPrice -= (int)$booking->discount;
                }
                @endphp
                @endif
                <tr>
                    <td>Remainder Due</td>
                    <td>&euro; {{ $finalPrice }}</td>
                </tr>
                <tr>
                    @php
                    $Date = date('Y-m-d');;
                    $days10 = date('Y-m-d', strtotime($Date. ' + 10 days'));
                    @endphp
                    <td>20% due within 10 days of this Invoice ({{ $days10 }})</td>
                    <td>&euro; {{ ($finalPrice)*0.2 }}</td>
                </tr>
                <tr>
                    @php
                        $Date = date($tour->start_date);
                        $weeks6 = date('Y-m-d', strtotime($Date. ' - 42 days'));
                    @endphp
                    <td>80% due 6 weeks before departure ({{$weeks6}})</td>
                    <td>&euro; {{ ($finalPrice)*0.8 }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="textfield">
        <p class="bold">Invoice to be paid to:</p>
    </div>
    <div class="textfield">
        <p>BikePlanet Tours</p>
        <p>Dorpsweg 10</p>
        <p>1697 KA Schellinkhout</p>
        <p>The Netherlands (NL)</p>
    </div>
    <div class="textfield">
        <p>Receiving Account number: (IBAN) NL61 RABO 0366579223</p>
        <p>BIC/SWIFT: RABONL2U</p>
    </div>
    <div class="textfield">
        <p>Rabobank Assen en Noord-Drenthe</p>
        <p>Neptunusplein 2</p>
        <p>NL 9401CZ Assen</p>
    </div>
    <div class="textfield">
        <p>Please pay exactly the right amount in Euros! </p>
    </div>
    <div class="textfield">
        <p>Payment by Credit Card (VISA or MASTERCARD only) is possible, extra costs are 3% of the payment,
            please add this to the amount you need to pay online. </p>
    </div>
    <div class="textfield">
        <p>CC payments at www.bikeplanet.tours/product/payment</p>
    </div>
    <div class="textfield">
        <p>Payment without extra costs can be easily arranged on  www.wise.com </p>
    </div>
    <div class="textfield">
        <p>Or ask your bank to take care of a bank wire. </p>
    </div>
</div>
</body>
</html>


