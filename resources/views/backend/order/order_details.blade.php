@php
    use App\Models\Product;
@endphp
@extends('backend.admin_master')

@section('admin')   

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    {{-- <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Order Product Code</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Created On</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach($order as $item)
                    <tr>
                        <th scope="row">{{ $item['id'] }}</th>
                        <td>
                            {{ $item['name'] }}
                        </td>
                        <td>
                            {{ $item['email'] }}
                        </td>
                        <td>
                            @foreach($item['order_product'] as $product)
                            {{$product['product_code'] }} 
                            ({{$product['product_qty']}})<br>
                            @endforeach
                        </td>
                        <td>{{ $item['payment_method'] }}</td>
                        <td>${{ $item['grand_total'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($item['created_at'])) }}</td>
                        <td>
                            <a href="{{route('order.details')}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
                
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content --> --}}

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Orders Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <tbody>
            
                        <tr>
                            <th>Order Date</th>
                            <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td scope="row">${{ $orderDetails['grand_total'] }}</td>
                        </tr>
            
                        <tr>
                            <th>Order Status</th>
                            <td>
                                {{ $orderDetails['order_status'] }}
                            </td>
                        </tr>
                        <tr>
                            <th>payment method</th>
                            <td>{{ $orderDetails['payment_method'] }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Charge</th>
                            <td>{{ $orderDetails['shipping_charge'] }}</td>
                        </tr>
                        <tr>
                            <th>Coupon Code</th>
                            <td>{{ $orderDetails['coupon_code'] }}</td>
                        </tr>
                        <tr>
                            <th>Coupon Amount</th>
                            <td>${{ $orderDetails['coupon_amount'] }}</td>
                        </tr>
                        @if($orderDetails['courier_name'])
                        <tr>
                          <th>Couirer Name</th>
                          <td>{{ $orderDetails['courier_name'] ?? 'None' }}</td>
                        </tr>
                        <tr>
                          <th>Tranking Number</th>
                          <td>{{ $orderDetails['traking_number']?? 'None' }}</td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
               
              </div>
              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Delivery Detailse</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $orderDetails['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td scope="row">{{ $orderDetails['email']  }}</td>
                        </tr>
            
                        <tr>
                            <th>Phone</th>
                            <td>
                                {{ $orderDetails['phone'] }}
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $orderDetails['address'] }}</td>
                        </tr>
                        <tr>
                            <th>Pin Code</th>
                            <td>{{ $orderDetails['pincode']  }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $orderDetails['city']  }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $orderDetails['country']  }}</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>


            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Customer Detailse</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $orderDetails['name'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td scope="row">{{ $orderDetails['email']  }}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Billing Detailse</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $userDetails['name'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td scope="row">{{ $userDetails['email']  }}</td>
                            </tr>
                
                            <tr>
                                <th>Phone</th>
                                <td>
                                    {{ $userDetails['phone'] }}
                                </td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $userDetails['address'] }}</td>
                            </tr>
                            <tr>
                                <th>Pin Code</th>
                                <td>{{ $userDetails['pincode']  }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $userDetails['city']  }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $userDetails['country']  }}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Update Order Status</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                      <table class="table table-sm">
                        <tbody>
                            <tr>
                                <form action="{{route('order.status.update')}}" method="POST">
                                    @csrf
                                    <div style="display: flex; gap: 5px">
                                      <input type="hidden" name="order_id" id="" value="{{ $orderDetails['id'] }}">
                                      {{-- <label for="">Update Status</label> --}}
                                      <select id="order_status" class="form-control" name="status">
                                          <option value="" disabled selected>-Select-</option>
                                          @foreach($orderStatus as $item)
                                              <option value="{{ $item['name'] }}" @if(@$orderDetails['order_status'] == $item['name'] ) selected  @endif >{{ $item['name'] }}</option>
                                          @endforeach
                                      </select>
                                      <br>
                                      <input class="form-control" placeholder="Curiere Name" type="text" name="courier_name" id="courier_name" style="display: none" ><br>
                                     
                                      <input class="form-control" placeholder="Traking No" type="text" name="traking_number" id="traking_number" style="display: none" ><br>
                                      <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    <br> <br>
                                </form>
                            </tr>
                            {{-- <hr> --}}
                            @foreach($orderLog as $item)
                            <tr>
                                <td>{{ $item['order_status'] }}</td>
                                <td> -- </td>
                                <td>{{ date('F j, Y, g:i a', strtotime($item['created_at'])) }}</td>
                                <td>{{@$item['reason']}}</td>
                                <td><a href="{{ route('admin.status.delete', $item['id']) }}" style="color: red;" id="delete"><i class="fa fa-trash"></i></a></td>                              
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Ordered Product</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                          <th scope="col">Produc Image</th>
                          <th scope="col">Produc Code</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Product Size</th>
                          <th scope="col">Product Color</th>
                          <th scope="col">Product Quantity</th>
                          <th scope="col">Rreturn Status</th>
                        </tr>
                      </thead>
                      <tbody>
              
                          @foreach($orderDetails['order_product'] as $item)
                          <tr>
                              <th scope="row">
                                  @php
                                    $img = Product::getProductImage($item['product_id']);
                                      // print_r($img['main_image']);
                                  @endphp
                                  <a target="_blank" href="{{ url('product/'.$item['id']) }}">
                                      <img src="{{URL::to('')}}/media/backend/product/large/{{ $img['main_image'] }}" alt="" style="width:40px ">
                                  </a>
                              </th>
                              <th scope="row">{{ $item['product_code'] }}</th>
                              <td>
                                  {{$item['product_name']}}
                              </td>
                              <td>{{ $item['product_size'] }}</td>
                              <td>{{ $item['product_color'] }}</td>
                              <td>{{ $item['product_qty'] }}</td>
                              <td style="color: red">{{ $item['return_order_status'] ?? 'None' }}</td>
                            </tr>
                          @endforeach
                        
                      </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </section>   
    </div>  
<!--/ wrapper -->

@endsection


