<?php 
use App\Models\Cart; 
use App\Models\Product;
?>


	<table class="table table-bordered">
		<thead>
		<tr>
			<th>Product</th>
			<th colspan="2">Description</th>
			<th>View/Delete</th>
			<th>Price</th>
		</tr>
		</thead>
		<tbody>
		
		@foreach($wishlistProduct as $item)
            <tr>
                <td> 
                    @if($item['get_product_details']['main_image'])
                    <img src="{{URL::to('')}}/media/backend/product/large/{{$item['get_product_details']['main_image']}}" alt="" style="width: 60px"/>
                    @else 
                    <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 60px"/>
                    @endif
                </td>
                <td colspan="2">{{ $item['get_product_details']['product_name'] }}<br/>
                    Color : {{ $item['get_product_details']['product_color'] }} <br>
                </td>
                <td>
                    <div class="input-append">
                        <button class="btn btn-info" type="button" cartId='{{ $item['id'] }}' ><i class="fa fa-eye icon-white"></i></button>	

                        <button class="btn btn-danger" type="button" cartId='{{ $item['id'] }}' ><i class="icon-remove icon-white"></i></button>				
                    </div>
                </td>

                <td>${{ $item['get_product_details']['product_price'] }}</td>
			</tr>
				
		@endforeach
		
		
		</tbody>
	</table>