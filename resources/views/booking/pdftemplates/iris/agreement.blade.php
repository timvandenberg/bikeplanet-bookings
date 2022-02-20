


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
            padding: 20px;
        }

        .header {
            height: 200px;
            width: 100%;
        }
        .half {
            float: left;
            width: 50%;

        }
        .logo {
            width: 200px;
        }
        .full {
            clear: both;
            margin: 0 0 20px 0;
        }
    </style>
</head>
<body>

    <div class="full header">
        <div class="half">
            <img class="logo" src="{{ asset('img/logo-pdf-iris.jpg') }}" alt="">
        </div>

        <div class="half" style="padding-top: 15px">
            <p style="margin-bottom: 5px"><strong>MPS IRIS BV</strong></p>
            <p>Tjeukemeerstraat 25</p>
            <p>8531 RK Lemmer</p>
            <p>The Netherlands</p>
            <p>Tel: <a href="tel:+31620245095">+31 6 20245095</a></p>
            <p>website: <a href="www.bikeplanet.tours">bikeplanet.tours</a></p>
            <p>e-mail: <a href="mailto:info@bikeplanet.tours">info@bikeplanet.tours</a></p>
            <p>VAT number: 44819627616.B01</p>
            <p>Chamber of Commerce number: 04058858</p>
        </div>
    </div>

    <div class="full">
        <p>{{ $title }}</p>
        <p>Street 123</p>
        <p>1234 LF Amsterdam</p>
        <p>United states of america</p>
    </div>

    <div class="full">
        <h2><strong>Agreement for Motor Passenger Ship Iris 2019</strong></h2>
    </div>

    <div class="full">
        <p><strong>RESERVATION NR : A-IRIS-2019-0608-1a-{{ $title }}<br>
        TOUR : {{ $tour->title }}<br>
        PASSENGERS: {{ $person_count }}</strong>
        </p>
    </div>

    <div class="full">
        <p>Herewith <strong>MPS Iris BV</strong>, operator of the passenger barge Iris set forth below, hereinafter to be referred to as <strong>“SUPPLIER”</strong>, confirms the following agreement between <strong>“SUPPLIER” AND: {{ $title }}</strong> hereinafter referred to as the "CUSTOMER";</p><br>
        <p>The Supplier shall provide to the Customer a Tour ("Voyage") on the Ship Iris, hereinafter
        referred to as the "Ship". The Ship shall correspond to the following description: 45.00 meters
        long, 6.60 meters wide; on lower deck 12 twin guest cabins (all lower, no bunk beds) with
        private facilities; on top deck a large dinner area and semi-separate lounge-bar area, sun deck;
        there will be an air conditioning system throughout the whole barge.
        The maximum number of passengers for Voyages of more than one day & night (number of
        beds) is 24. The crew shall consist of {{ $tour->crew }} members and {{ $tour->guides }} guides.</p>
    </div>

    <div class="full">
        <p>The Voyage shall begin on {{ $tour->start_datetime }} in {{ $tour->start_location }}  = port of embarkation.<br>
        The Voyage shall end on {{ $tour->end_datetime }} in {{ $tour->end_location }} = port of disembarkation.</p>
    </div>

    <div class="full">
        <p><strong>The price for this tour is €&nbsp;{{ $person_count*$price}},-- ( {{ $person_count }} x €&nbsp;{{ $price }},-- + 2 x €&nbsp;85,-- bike rent)<br>
        and includes:</strong><br>
        {!! $tour->invoice_text !!}
        {{ $tour->guides }} Guides<br>
        {{ $person_count }} Bikes including insurance, water bottle and pannier</p>
    </div>

    <div class="full">
        <p>Conditions of payment of the agreed price by customer (Customer will receive invoice):<br>
        20% of the price = €&nbsp;{{ $person_count*$price*0.2 }},--   to be paid before October 23, 2018, not refundable <br>
        80% of the price = €&nbsp;{{ $person_count*$price*0.8 }},-- to be paid before April 27, 2019  (6 weeks prior to the departure date)<br>
        <strong>The General Conditions of MPS IRIS BV are applicable to this agreement!</strong>
        </p>
    </div>

    <div class="full">
        <p>Bankaccount (IBAN): <strong>NL 22 ABNA 0449 7366 87</strong><br>SWIFT/BIC Code: <strong>ABNANL2A</strong></p>
    </div>
</body>
</html>


