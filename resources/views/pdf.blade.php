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
            font-size: 14px;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            /*font-size: x-small;*/
			text-align: left;
			border-spacing: 0;
			border-collapse: collapse;
        }
        .invoice table th{            
			padding: 0.5rem 0;
        }       
        tfoot tr td {
            padding: .5rem 0;
        }
        .invoice {
            padding: 5%;
        }
        /*.invoice table {
            margin: 15px;
        }*/
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
			padding: 5%;
            background-color: #fff;
            color: #000;
            /*border-bottom: 4px solid #3b74ba;*/
        }
        .information .logo {
            margin: 5px;
        }
        /*.information table {
            padding: 5%;
        }*/
    </style><!--E: 
                    P:  <p>Date: {{ date("d M Y") }}</p>-->

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 25%;">
				<h3 style="padding-top: 48px; font-size: 30px;">QUOTE</h3>
                <p style="margin-left: 50px;">
					Customer:<br/><br/>
					{{ $quote->c_name }}<br />
					{{ $quote->address_1 }} {{ $quote->address_2 }}<br />
                    {{ $quote->city }} {{ $quote->post_code }}<br />
					{{ $quote->c_email }}<br />
					{{ $quote->c_contact }}<br />
				</p>
            </td>
            <td align="center" style="width: 40%;">
                
            </td>
            <td align="left" style="width: 35%;">
				<img src="https://360degreesfs.com.au/wp-content/uploads/2019/06/cropped-111.png" width="100px;" class="logo"/>
                <h3></h3>
				<p>	
					360 Degrees Facility Services<br>
					3/20 Fullarton Road, 
                    Norwood SA 5067<br />
                    admin@360degreesfs.com.au<br />
                    (08) 8362 3100
                </p>
				<p>
                    <?php
                        $expiry_date = date( "d M Y", strtotime( $quote->expiry_date ) );
						$draft_date = date( "d M Y", strtotime( $quote->draft_date ) );
                    ?>
                    <table style="width: 100%;">
                        <tr>
                            <td>Quote Number: </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 10px;">{{ $quote->quote_number }}  </td>
                        </tr>
                        <tr>
                            <td>Date: </td>
                            <td>Expiry Date:</td>
                        </tr>
                        <tr>
                            <td>{{ $draft_date }} </td>
                            <td>{{ $expiry_date }}</td>
                        </tr>
                    </table>                                         
                </p>
            </td>
        </tr>

    </table>
</div>

<div class="invoice" style="margin-top: -60px;">
    
    <table width="100%" style="margin: 0 auto;">
        <thead>
			<tr>
                <th style="width: 20%;">Item</th>
                <th style="width: 35%;">Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th align="right">Amount AUD</th>
            </tr>
			<tr><td style="border-top:2px solid black;" colspan="5"></td></tr>
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
                <td align="right">Sub Total</td>
                <td align="right"> {{ $quote->grand_total }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">GST Tax 10%</td>
                <td align="right"> {{ $quote->tax }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right" style="border-top: 2px solid #000;border-bottom: 2px solid #000;padding: 0.5rem;">Total AUD</td>
                <td align="right" style="border-top: 2px solid #000;border-bottom: 2px solid #000;padding: 0.5rem 0.1rem 0.5rem;"> {{ $quote->total }}</td>
            </tr>
        </tfoot>
    </table>
	
	<p>Looking forward for your business.<br/> If you have any questions about this quotation please don't hesitate to contact us.</p>

</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
               360 Degrees Facility Services
            </td>
        </tr>
    </table>
</div>

</body>
</html>