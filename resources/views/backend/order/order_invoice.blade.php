<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<style>

    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2>
                <h3 class="pull-right">Order # {{ $orderDetails['id'] }}</h3>
                <span>
                    @php
                        echo DNS1D::getBarcodeHTML($orderDetails['id'], 'C39');
                    @endphp
                </span>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                    {{ $userDetails['name'] }}<br>
                    {{ $userDetails['address'] }}<br>
                    {{ $userDetails['city'] }}<br>
                    {{ $userDetails['country'] }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{ $userDetails['name'] }}<br>
    					{{ $userDetails['address'] }}<br>
    					{{ $userDetails['city'] }}<br>
    					{{ $userDetails['country'] }}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{ $orderDetails['payment_method'] }}<br>
    					{{ $userDetails['country'] }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{ date('F j, Y', strtotime($orderDetails['created_at'] )) }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                @php
                                    $subTotal = 0;
                                @endphp
    							@foreach($orderDetails['order_product'] as $item)
                                <tr>
    								<td>
                                        Name : {{ $item['product_name'] }} <br>
                                        Size : {{ $item['product_size'] }}<br>
                                        Color : {{ $item['product_color'] }}<br>
                                        Code : {{ $item['product_code'] }}
                                    </td>
    								<td class="text-center">${{ $item['product_price'] }}</td>
    								<td class="text-center">{{ $item['product_qty'] }}</td>
    								<td class="text-right">${{ $item['product_price'] * $item['product_qty'] }}</td>
    							</tr>

                                @php
                                    $subTotal = $subTotal + ($item['product_price'] * $item['product_qty']);
                                @endphp

                                @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">${{$subTotal}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">${{ $orderDetails['shipping_charge'] }}</td>
    							</tr>
                                <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Coupon Discount</strong></td>
    								<td class="no-line text-right">${{ $orderDetails['coupon_amount'] }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">${{ $orderDetails['grand_total'] }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>