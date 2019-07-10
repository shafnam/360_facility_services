<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <title>Invoice - #123</title> -->

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        .invoice table {
            border: 1px solid #efefef;
        }        
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice, .invoice table {
            padding: 10px;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #fff;
            color: #000;
            /*border-bottom: 4px solid #3b74ba;*/
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>{{ $quote->c_name }}</h3>
                <p>
                    E: {{ $quote->c_email }}<br />
                    P: {{ $quote->c_contact }}<br />
                    {{ $quote->address_1 }} {{ $quote->address_2 }}<br />
                    {{ $quote->city }} {{ $quote->post_code }}<br />
                    <br /><br />
                    <?php
                        $expiry_date = date( "d-m-Y", strtotime( $quote->expiry_date ) );
                    ?>
                    Expiry Date: {{ $expiry_date }}<br />
                    Quote Number: {{ $quote->quote_number }}
                </p>
            </td>
            <td align="center">
                <img src="https://360degreesfs.com.au/wp-content/uploads/2019/06/cropped-111.png" width="100px;" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">

                <h3>360 Degrees Facility Services</h3>
                <pre>
                    <a href="https://360degreesfs.com.au">360degreesfs.com.au</a>
                    E: admin@360degreesfs.com.au<br/> 
                    P: (08) 8362 3100<br/> 
                    3/20 Fullarton Road, 
                    Norwood S.A 5067
                </pre>
            </td>
        </tr>

    </table>
</div>

<br/>

<div class="invoice">
    
    <table width="100%" style="margin: 0 auto;">
        <thead style="background: #efefef;">
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price($)</th>
                <th align="right">Sub Total($)</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($quote_items as $qi) 
            <tr>
                <td>{{ $qi->name }}</td>
                <td>{{ $qi->description }}</td>
                <td>{{ $qi->qty }}</td>
                <td>{{ $qi->unit_price }}</td>
                <td align="right">{{ $qi->sub_total }}</td>
            </tr>
            @endforeach            
        </tbody>
        <tfoot>
            <!-- <tr>
                <td colspan="5"></td>
            </tr> -->
            <tr>
                <td colspan="3"></td>
                <td align="left">Grand Total ($)</td>
                <td align="right"> {{ $quote->grand_total }} </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="left">GST Tax (10%)</td>
                <td align="right"> {{ $quote->tax }} </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="left">Net Total ($)</td>
                <td align="right"> {{ $quote->total }} </td>
            </tr>
        </tfoot>
    </table>

    <!-- <p style="margin: 0 auto; width:75%;">Photos</p>

    <table width="75%" style="margin: 0 auto;">
        <tbody>
            <tr>
            @foreach ($quote_photos as $qp)    
                <td>
                    <img src="" alt="" height="250px">
                </td>
            @endforeach
            </tr>
        </tbody>   
    </table> -->

</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
               360 Facility Services
            </td>
        </tr>
    </table>
</div>

</body>
</html>