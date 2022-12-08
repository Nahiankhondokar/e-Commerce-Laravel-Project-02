{{-- 
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }

            a {
            color: #5D6975;
            text-decoration: underline;
            }

            body {
            position: relative;
            width: 21cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
            }

            header {
            padding: 10px 0;
            margin-bottom: 30px;
            }

            #logo {
            text-align: center;
            margin-bottom: 10px;
            }

            #logo img {
            width: 90px;
            }

            h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
            }

            #project {
            float: left;
            }

            #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
            }

            #company {
            float: right;
            text-align: right;
            }

            #project div,
            #company div {
            white-space: nowrap;        
            }

            table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
            background: #F5F5F5;
            }

            table th,
            table td {
            text-align: center;
            }

            table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
            }

            table .service,
            table .desc {
            text-align: left;
            }

            table td {
            padding: 20px;
            text-align: right;
            }

            table td.service,
            table td.desc {
            vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
            font-size: 1.2em;
            }

            table td.grand {
            border-top: 1px solid #5D6975;;
            }

            #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
            }

            footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            }
    </style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />


  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>INVOICE 3-2-1</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>PROJECT</span> Website development</div>
        <div><span>CLIENT</span> John Doe</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SERVICE</th>
            <th class="desc">DESCRIPTION</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">Design</td>
            <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">26</td>
            <td class="total">$1,040.00</td>
          </tr>
          <tr>
            <td class="service">Development</td>
            <td class="desc">Developing a Content Management System-based Website</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
          </tr>
          <tr>
            <td class="service">SEO</td>
            <td class="desc">Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
          <tr>
            <td class="service">Training</td>
            <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
            <td class="unit">$40.00</td>
            <td class="qty">4</td>
            <td class="total">$160.00</td>
          </tr>
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
          <tr>
            <td colspan="4">TAX 25%</td>
            <td class="total">$1,300.00</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">$6,500.00</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />

    <style>

        @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #0087C3;
        text-decoration: none;
        }

        body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #555555;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 14px; 
        font-family: SourceSansPro;
        }

        header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
        }

        #logo {
        float: left;
        margin-top: 8px;
        }

        #logo img {
        height: 70px;
        }

        #company {
        float: right;
        text-align: right;
        }


        #details {
        margin-bottom: 50px;
        }

        #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        }

        #invoice {
        float: right;
        text-align: right;
        }

        #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }

        #invoice .date {
        font-size: 1.1em;
        color: #777777;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table th,
        table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        table th {
        white-space: nowrap;        
        font-weight: normal;
        }

        table td {
        text-align: right;
        }

        table td h3{
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #57B223;
        }

        table .desc {
        text-align: left;
        }

        table .unit {
        background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
        background: #57B223;
        color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table tbody tr:last-child td {
        border: none;
        }

        table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
        }

        table tfoot tr:first-child td {
        border-top: none; 
        }

        table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223; 

        }

        table tfoot tr td:first-child {
        border: none;
        }

        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }

        #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
        }

        #notices .notice {
        font-size: 1.2em;
        }

        footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
        }

        

    </style>

  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <h2>Order Invoice</h2>
      </div>
      <div id="company">
        <h2 class="name">Ecommerce Website</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $orderDetails['name'] }}</h2>
          <div class="address">{{ $orderDetails['address'] }}, {{ $orderDetails['country'] }}</div>
          <div class="email"><a href="mailto:john@example.com">{{ $orderDetails['email'] }}</a></div>
        </div>
        <div id="invoice">
          <h1>Order ID # {{ $orderDetails['id'] }}</h1>
          <div class="date">Date of Invoice: {{ $orderDetails['payment_method'] }}</div>
          <div class="date">Payment Method: {{ date('F j, Y', strtotime($orderDetails['created_at'] )) }}</div>
          {{-- <div class="date">Due Date: {{ $orderDetails['country'] }}</div> --}}
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">Code</th>
            <th class="desc">Size</th>
            <th class="unit">Color</th>
            <th class="total">Price</th>
            <th class="qty">Quantity</th>
            <th class="total">Total</th>
          </tr>
        </thead>
        <tbody>
            @php
                $subTotal = 0;
            @endphp
            @foreach($orderDetails['order_product'] as $item )
            <tr>
                <td class="no">{{ $item['product_code'] }}</td>
                <td class="desc">{{ $item['product_size'] }}</td>
                <td class="unit">{{ $item['product_color'] }}</td>
                <td class="total">${{ $item['product_price'] }}</td>
                <td class="qty">{{ $item['product_qty'] }}</td>
                <td class="total">${{ $item['product_price'] * $item['product_qty'] }}</td>
              </tr>

              @php
                  $subTotal = $subTotal + ($item['product_price'] * $item['product_qty']);
              @endphp

            @endforeach
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>${{$subTotal}}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Shipping Charge</td>
            <td>${{ $orderDetails['shipping_charge'] ?? 00 }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Tax Charge</td>
            <td>${{ $orderDetails['tax'] ?? 00 }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Coupon Discount</td>
            <td>${{ $orderDetails['coupon_amount'] ?? 00 }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>${{ $orderDetails['grand_total'] }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>




