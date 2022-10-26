{{-- 
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			<address contenteditable>
				<p>Jonathan Neal</p>
				<p>101 E. Chapman Ave<br>Orange, CA 92866</p>
				<p>(800) 555-1234</p>
			</address>
			<span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address contenteditable>
				<p>Some Company<br>c/o Some Guy</p>
			</address>
			<table class="meta">
				<tr>
					<th><span contenteditable>Invoice #</span></th>
					<td><span contenteditable>101138</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><span contenteditable>{{ date('d-m-Y') }}</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Item</span></th>Item  Code 
						<th><span contenteditable>Code</span></th>
                        <th><span contenteditable>Color</span></th>
						<th><span contenteditable>Quantity</span></th>
                        
						<th><span contenteditable>Price</span></th>
					</tr>
				</thead>
				<tbody>
                    @foreach($orderDetails['order_product'] as $item)
                    <tr>
						<td><a class="cut">-</a><span contenteditable>{{ $item['product_name'] }}</span></td>
						<td><span contenteditable>{{ $item['product_code'] }}</span></td>
						
                        <td><span contenteditable>{{ $item['product_color'] }}</span></td>
						<td><span contenteditable>{{ $item['product_qty'] }}</span></td>
                        <td><span data-prefix>$</span><span contenteditable>{{ $item['product_price'] }}</span></td>
					</tr>
                    @endforeach
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
                <tr>
					<th><span contenteditable>Shipping Charge</span></th>
					<td><span data-prefix>$</span><span>${{ $orderDetails['shipping_charge'] ?? 00 }}</span></td>
				</tr>
                <tr>
					<th><span contenteditable>Coupon Amount</span></th>
					<td><span data-prefix>$</span><span>${{ $orderDetails['coupon_amount'] ?? 00 }}</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>$</span><span>{{ $orderDetails['grand_total'] }}</span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1><span contenteditable>Additional Notes</span></h1>
			<div contenteditable>
				<p>Thank you For shopping.</p>
			</div>
		</aside>
	</body>
</html>


<style>

    /* reset */

    *
    {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    /* content editable */

    *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

    *[contenteditable] { cursor: pointer; }

    *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

    span[contenteditable] { display: inline-block; }

    /* heading */

    h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

    /* table */

    table { font-size: 75%; table-layout: fixed; width: 100%; }
    table { border-collapse: separate; border-spacing: 2px; }
    th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
    th, td { border-radius: 0.25em; border-style: solid; }
    th { background: #EEE; border-color: #BBB; }
    td { border-color: #DDD; }

    /* page */

    html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
    html { background: #999; cursor: default; }

    body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
    body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

    /* header */

    header { margin: 0 0 3em; }
    header:after { clear: both; content: ""; display: table; }

    header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
    header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
    header address p { margin: 0 0 0.25em; }
    header span, header img { display: block; float: right; }
    header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
    header img { max-height: 100%; max-width: 100%; }
    header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

    /* article */

    article, article address, table.meta, table.inventory { margin: 0 0 3em; }
    article:after { clear: both; content: ""; display: table; }
    article h1 { clip: rect(0 0 0 0); position: absolute; }

    article address { float: left; font-size: 125%; font-weight: bold; }

    /* table meta & balance */

    table.meta, table.balance { float: right; width: 36%; }
    table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

    /* table meta */

    table.meta th { width: 40%; }
    table.meta td { width: 60%; }

    /* table items */

    table.inventory { clear: both; width: 100%; }
    table.inventory th { font-weight: bold; text-align: center; }

    table.inventory td:nth-child(1) { width: 26%; }
    table.inventory td:nth-child(2) { width: 38%; }
    table.inventory td:nth-child(3) { text-align: right; width: 12%; }
    table.inventory td:nth-child(4) { text-align: right; width: 12%; }
    table.inventory td:nth-child(5) { text-align: right; width: 12%; }

    /* table balance */

    table.balance th, table.balance td { width: 50%; }
    table.balance td { text-align: right; }

    /* aside */

    aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
    aside h1 { border-color: #999; border-bottom-style: solid; }

    /* javascript */

    .add, .cut
    {
        border-width: 1px;
        display: block;
        font-size: .8rem;
        padding: 0.25em 0.5em;	
        float: left;
        text-align: center;
        width: 0.6em;
    }

    .add, .cut
    {
        background: #9AF;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
        background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
        background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
        border-radius: 0.5em;
        border-color: #0076A3;
        color: #FFF;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
    }

    .add { margin: -2.5em 0 0; }

    .add:hover { background: #00ADEE; }

    .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
    .cut { -webkit-transition: opacity 100ms ease-in; }

    tr:hover .cut { opacity: 1; }

    @media print {
        * { -webkit-print-color-adjust: exact; }
        html { background: none; padding: 0; }
        body { box-shadow: none; margin: 0; }
        span:empty { display: none; }
        .add, .cut { display: none; }
    }

    @page { margin: 0; }

</style> --}}




{{-- <!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ecommer Website</title>
  {{-- <link rel="stylesheet" href="./style.css"> --}}

  {{-- <style>

    table {
    border-spacing: 1;
    border-collapse: collapse;
    background: white;
    border-radius: 6px;
    overflow: hidden;
    max-width: 800px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    }
    table * {
    position: relative;
    }
    table td, table th {
    padding-left: 8px;
    }
    table thead tr {
    height: 60px;
    background: #FFED86;
    font-size: 16px;
    }
    table tbody tr {
    height: 48px;
    border-bottom: 1px solid #E3F1D5;
    }
    table tbody tr:last-child {
    border: 0;
    }
    table td, table th {
    text-align: left;
    }
    table td.l, table th.l {
    text-align: right;
    }
    table td.c, table th.c {
    text-align: center;
    }
    table td.r, table th.r {
    text-align: center;
    }

    @media screen and (max-width: 35.5em) {
    table {
        display: block;
    }
    table > *, table tr, table td, table th {
        display: block;
    }
    table thead {
        display: none;
    }
    table tbody tr {
        height: auto;
        padding: 8px 0;
    }
    table tbody tr td {
        padding-left: 45%;
        margin-bottom: 12px;
    }
    table tbody tr td:last-child {
        margin-bottom: 0;
    }
    table tbody tr td:before {
        position: absolute;
        font-weight: 700;
        width: 40%;
        left: 10px;
        top: 0;
    }
    table tbody tr td:nth-child(1):before {
        content: "Code";
    }
    table tbody tr td:nth-child(2):before {
        content: "Stock";
    }
    table tbody tr td:nth-child(3):before {
        content: "Cap";
    }
    table tbody tr td:nth-child(4):before {
        content: "Inch";
    }
    table tbody tr td:nth-child(5):before {
        content: "Box Type";
    }
    }
    body {
    background: #9BC86A;
    font: 400 14px 'Calibri','Arial';
    padding: 20px;
    }

    blockquote {
    color: white;
    text-align: center;
    }

</style>

</head>
<body> --}}
<!-- partial:index.partial.html -->
{{-- 
<div style="text-align: center;">
    <h3>E-Commerce Website</h3>
    <p>Jonathan Neal</p>
    <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
    <p>(800) 555-1234</p>
    <p> Invoice No : <strong>423425ERW34</strong> </p>
    <p> {{ date('d-m-Y') }} </p>
</div>

<table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Code</th>
          <th>Color</th>
          <th>Size</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
      <thead>
      <tbody>
        @foreach($orderDetails['order_product'] as $item)
        <tr>
          <td>{{ $item['product_name'] }}</td>
          <td>{{ $item['product_code'] }}</td>
          <td>{{ $item['product_color'] }}</td>
          <td>{{ $item['product_size'] }}</td>
          <td>{{ $item['product_qty'] }}</td>
          <td>{{ $item['product_price'] }}</td>
        </tr>
        @endforeach
      </tbody>
<table/>

<table>
    <tbody>

      <tr>
        <th>Shipping Charge</th>
        <td>${{ $orderDetails['shipping_charge'] ?? 00 }}</td>
      </tr>
      <tr>
        <th>Coupon Amount</th>
        <td>${{ $orderDetails['coupon_amount'] ?? 00 }}</td>
      </tr>
      <tr>
        <th>Total Amount</th>
        <td>${{ $orderDetails['grand_total']}}</td>
      </tr>
        
    </tbody>
<table/>
      
    <blockquote> Responsive Table </blockquote>
<!-- partial -->
  
</body>
</html> --}}






<div class="container">
     
    <div class="row pad-top-botm ">
       <div class="col-lg-6 col-md-6 col-sm-6 ">
          <img src="assets/img/logo.jpg" style="padding-bottom:20px;"> 
       </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          
             <strong>Brian Bossier Design</strong>
            <br>
                <i>Address :</i> Barrington, IL
            <br>
                89th street , Suite 69,
            <br>
                United States.
            
       </div>
   </div>
   <div class="row text-center contact-info">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <hr>
           <span>
               <strong>Email : </strong>  brian@brianbossierdesign.com 
           </span>
           <span>
               <strong>Call : </strong>  +1-623-777-9044 
           </span>
            <span>
               <strong>Fax : </strong>  +012340-908- 890 
           </span>
           <hr>
       </div>
   </div>
   <div class="row pad-top-botm client-info">
       <div class="col-lg-6 col-md-6 col-sm-6">
       <h4>  <strong>Client Information</strong></h4>
         <strong> {{ $userDetails['name'] }} </strong>
           <br>
                <b>Address :</b> {{ $userDetails['address'] }}
            <br>
            {{ $userDetails['country'] }}
           <br>
           <b>Call :</b> {{ $userDetails['phone'] }}
            <br>
           <b>E-mail :</b>{{ $userDetails['email'] }}
       </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          
             <h4>  <strong>Payment Details </strong></h4>
          <b>Bill Amount :  990 USD </b>
            <br>
             Bill Date :  01th August 2014
            <br>
             <b>Payment Status :  Paid </b>
             <br>
             Delivery Date :  10th August 2014
            <br>
             Purchase Date :  30th July 2014
       </div>
   </div>
   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Code</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <thead>
                    <tbody>
                    @foreach($orderDetails['order_product'] as $item)
                    <tr>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['product_code'] }}</td>
                        <td>{{ $item['product_color'] }}</td>
                        <td>{{ $item['product_size'] }}</td>
                        <td>{{ $item['product_qty'] }}</td>
                        <td>{{ $item['product_price'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
            <table/>
                            
           
             </div>
           <hr>
            <div class="ttl-amts">
                <h5>  Shipping Charge : ${{ $orderDetails['shipping_charge'] ?? 00 }}  </h5>
           </div>
           <hr>
           <div class="ttl-amts">
            <h5>  Coupon Discount : ${{ $orderDetails['coupon_amount'] ?? 00 }}  </h5>
            </div>
            <hr>
           <div class="ttl-amts">
            <h5>  Total Amount : ${{ $orderDetails['grand_total']}} </h5>
          </div>
       </div>
   </div>
    <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
          <strong> Important: </strong>
           <ol>
                <li>
                  This is an electronic generated invoice so doesn't require any signature.

               </li>
               <li>
                   Please read all terms and polices on  www.yourdomaon.com for returns, replacement and other issues.

               </li>
           </ol>
           </div>
       </div>
    <div class="row pad-top-botm">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <hr>
           <a href="#" class="btn btn-primary btn-lg">Print Invoice</a>
           &nbsp;&nbsp;&nbsp;
            <a href="#" class="btn btn-success btn-lg">Download In Pdf</a>

           </div>
       </div>

       <style>
    

        /* =============================================================
        GENERAL STYLES
        ============================================================ */
        body {
            font-family: 'Open Sans', sans-serif;
            font-size:16px;
            line-height:30px;
        }
        .pad-top-botm {
            padding-bottom:40px;
            padding-top:60px;
        }
        h4 {
            text-transform:uppercase;
        }
        /* =============================================================
        PAGE STYLES
        ============================================================ */
    
        .contact-info span {
            font-size:14px;
            padding:0px 50px 0px 50px;
        }
    
        .contact-info hr {
            margin-top: 0px;
        margin-bottom: 0px;
        }
    
        .client-info {
            font-size:15px;
        }
    
        .ttl-amts {
            text-align:right;
            padding-right:50px;
        }
    </style>
</div>
