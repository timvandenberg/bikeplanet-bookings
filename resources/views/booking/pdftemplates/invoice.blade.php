


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
            padding: 10px;
            background-color: rgba(0,0,0,0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        .td-align-right {
            text-align: right;
        }

        .bl {
            border-left: 1px solid #000;
        }
        .bt {
            border-top: 1px solid #000;
        }
        .br {
            border-right: 1px solid #000;
        }
        .bb {
            border-bottom: 1px solid #000;
        }
        .small {
            font-size: 14px;
        }
    </style>
</head>
<body>
    @php( $tourPrice = $person_count*$price )
    @php( $subTotal = $tourPrice )
    @php( $subTotal += ($ebikeCount*150) )
    @php( $subTotal += ($hybridCount*150) )
    @php( $subTotal += ($vegetarianCount*80) )
    @php( $subTotal += ($veganCount*100) )
    @php( $finalPrice = $subTotal )

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

    <div class="half">
        <h2>Invoice</h2>
        <p>Date: {{ $date }}</p>
        <p>Invoice number: I-IRIS-2019-0608-1a-{{$title}}-1</p>
    </div>

    <div class="half">
        <h2>To</h2>
        <p>{{ $title }}</p>
        <p>Street 123</p>
        <p>1234 LF Amsterdam</p>
        <p>United states of america</p>
    </div>

    <div class="full">
        <table>
            <thead>
                <tr class="bt bb bl br">
                    <th class="bt bb bl br">Description</th>
                    <th class="bt bb bl br">Amount</th>
                    <th class="bt bb bl br">Price</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="bb bl">
                        Bike & Barge: {{ $tour->title }} |{{ $tour->start_date }} - {{ $tour->end_date }}|
                    </td>
                    <td class="bl bb">{{ $person_count }}</td>
                    <td class="br bl">{{ $tourPrice }}</td>
                </tr>

                @if($ebikeCount)
                <tr>
                    <td class="bb bl">
                        E-bike
                    </td>
                    <td class="bl br bb">{{ $ebikeCount }}</td>
                    <td class="br bt">{{ $ebikeCount*150 }}</td>
                </tr>
                @endif

                @if($hybridCount)
                <tr>
                    <td class="bb bl">
                        Hybrid Bike
                    </td>
                    <td class="bl br bb">{{ $hybridCount }}</td>
                    <td class="br bt">{{ $hybridCount*120 }}</td>
                </tr>
                @endif

                @if($vegetarianCount)
                <tr>
                    <td class="bb bl">
                        Vegetarian menu
                    </td>
                    <td class="bl br bb">{{ $vegetarianCount }}</td>
                    <td class="br bt">{{ $vegetarianCount*80 }}</td>
                </tr>
                @endif

                @if($veganCount)
                <tr>
                    <td class="bb bl">
                        Vegan menu
                    </td>
                    <td class="bl br bb">{{ $veganCount }}</td>
                    <td class="br bt">{{ $veganCount*100 }}</td>
                </tr>
                @endif

                <tr>
                    <td></td>
                    <td class="td-align-right">Subtotal</td>
                    <td class="bl br bb bt">{{ $subTotal }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-align-right">VAT (6% incl)</td>
                    <td class="bl br bb">{{ $subTotal*0.06 }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-align-right"><strong>Total</strong></td>
                    <td class="bl br bb">{{ $subTotal }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="full">
        <h2>Payment</h2>
        <table>
            <thead>
                <tr>
                    <th class="bt bb bl br">Type</th>
                    <th class="bt bb bl br">Part</th>
                    <th class="bt bb bl br">Due</th>
                    <th class="bt bb bl br">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bt bb bl br">First Payment</td>
                    <td class="bt bb bl br">20%</td>
                    <td class="bt bb bl br">October 23, 2018</td>
                    <td class="bt bb bl br">€&nbsp;{{ $finalPrice*0.2 }},--</td>
                </tr>
                <tr>
                    <td class="bt bb bl br">Final payment</td>
                    <td class="bt bb bl br">80%</td>
                    <td class="bt bb bl br">April 27, 2019</td>
                    <td class="bt bb bl br">€&nbsp;{{ $finalPrice*0.8 }},--</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="full">
        <h2>To be paid to:</h2>
        <p>MPS IRIS BV</p>
        <p>Bankaccount (IBAN): NL 22 ABNA 0449 7366 87<br>
            SWIFT/BIC Code: ABNANL2A</p>
    </div>

    <div class="full">
        <p class="small">Please pay exactly the right amount in Euros!<br>
        Payment by Credit Card is possible, extra costs are 3% of the payment. Visit out <a href="https://www.bikeplanet.tours/product/payment">payment page</a> and fill in the adjusted amount to pay.<br>
        Payment without extra costs can be easily arranged on <a href="https://wise.com/" target="_blank">wise.com</a></p>
    </div>

</body>
</html>


