


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
        th {
            text-align: left;
            padding: 20px 10px;
            border-bottom: 1px solid #000;
        }
        table {
            width: 100%;
            border: 1px solid black;
            height: 300px;
        }
        td {
            padding: 10px;
            vertical-align: top;
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
        <h1>Invoice {{ $title }}</h1>
    </div>

    <div class="full">
        <p><strong>Agreement for Motor Passenger Ship Iris 2019</strong></p>
    </div>

    <div class="full">
        <p><strong>RESERVATION NR : A-IRIS-2019-0608-1a-{{ $title }}<br>
        TOUR : Bike and Barge Moselle<br>
        PASSENGERS: {{ $person_count }}</strong>
        </p>
    </div>
    <div class="full">
        <p>{{ $tour->invoice_text }}</p>
    </div>

    <div class="full">
        <p>The Voyage shall begin on {{ $tour->start_datetime }} in {{ $tour->start_location }}  = port of embarkation.<br>
        The Voyage shall end on {{ $tour->end_datetime }} in {{ $tour->end_location }} = port of disembarkation.</p>
    </div>

    <div class="full">
        <p><strong>
            The price for this tour is {{ $price }}
        </strong></p>
    </div>

    <div class="full">
        <table> 
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><p>
                        Tour for 1 passenger:<br>
                        7 nights in 1 twin cabin <br>
                        7 days breakfast<br>
                        6 days 3 course dinner <br>
                        7 days lunch supplies for picnic<br>
                        Coffee and tea on board<br>
                        2 guides<br>
                        1 Bike including insurance, water bottle and pannier</p>
                    </td>
                    <td>{{ $price }}</td>
                </tr>
            </tbody>
        </table>
        
    </div>

    <div class="full">
        
    </div>

    <div class="full">
        <p>Conditions of payment of the agreed price by customer (Customer will receive invoice):<br>
        20% of the price = €&nbsp;{{ $price*0.2 }},--   to be paid before October 23, 2018, not refundable <br>
        80% of the price = €&nbsp;{{ $price*0.8 }},-- to be paid before April 27, 2019  (6 weeks prior to the departure date)<br>
        <strong>The General Conditions of MPS IRIS BV are applicable to this agreement!</strong>
        </p>
    </div>

    <div class="full">
        <p>Bankaccount (IBAN): NL 22 ABNA 0449 7366 87,   SWIFT/BIC Code: ABNANL2A</p>
    </div>
</body>
</html>


