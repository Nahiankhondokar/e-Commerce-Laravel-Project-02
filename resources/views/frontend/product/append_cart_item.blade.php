<?php 
use App\Models\Cart; 
use App\Models\Product;
?>


	<table class="table table-bordered">
		<thead>
		<tr>
			<th>Product</th>
			<th colspan="2">Description</th>
			<th>Quantity/Update</th>
			<th>Price/Unit</th>
			<th>Discount</th>
			<th>Sub Total</th>
		</tr>
		</thead>
		<tbody>
		<?php $total = 0; ?>
		
		@foreach($userCartItems as $item)
		<?php 
			$getProductPrice = Cart::getProductPrice($item['product_id'], $item['size']);
			$discount = Product::getAttrDiscountPrice($item['product_id'], $item['size']);

			// dd($discount) -> toArray();
		?>
		<tr>
			<td> 
				@if($item['get_product']['main_image'])
				<img src="{{URL::to('')}}/media/backend/product/large/{{$item['get_product']['main_image']}}" alt="" style="width: 60px"/>
				@else 
				<img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 60px"/>
				@endif
			</td>
			<td colspan="2">{{ $item['get_product']['product_name'] }}<br/>
				Color : {{ $item['get_product']['product_color'] }} <br>
				Size : {{ $item['size'] }}
			</td>
			<td>
				<div class="input-append">
				<input class="span1" style="max-width:34px" value="{{$item['quantity']}}" id="appendedInputButtons-{{$item['id']}}" size="16" type="text">

				<button class="btn btnItemUpdate qtyDecrement" cartId='{{ $item['id'] }}' type="button"><i class="icon-minus"></i></button>

				<button class="btn btnItemUpdate qtyIncrement" cartId='{{ $item['id'] }}'  type="button"><i class="icon-plus"></i></button>

				<button class="btn btn-danger cartitemDelete" type="button" cartId='{{ $item['id'] }}' ><i class="icon-remove icon-white"></i></button>				
			</div>
			</td>
			{{-- {{ print_r($discount) }} --}}
			<td>${{ $getProductPrice }}</td>
			<td>${{$discount['discountAmount']}}</td>
			<td>
				{{$discount['attrDiscountPrice'] * $item['quantity']}}
			</td>
			</tr>
			<?php 
			$total = $total + ($discount['attrDiscountPrice'] * $item['quantity']); 
			?>
				
		@endforeach
		
		
		<tr>
			<td colspan="6" style="text-align:right">Sub Total Price:	</td>
			<td> ${{$total}}</td>
		</tr>
			<tr>
			<td colspan="6" style="text-align:right">Coupon Discount:	</td>
			<td class="couponDiscount">
				$00
			</td>
		</tr>
			<tr>
			<td colspan="6" style="text-align:right"><strong>GRAND TOTAL (${{$total}}  - <span class="couponDiscount"> $00</spanc> ) =</strong></td>
			<td class="label label-important" style="display:block"> <strong class="grandTotal"> ${{$total}} </strong></td>
		</tr>
		</tbody>
	</table>