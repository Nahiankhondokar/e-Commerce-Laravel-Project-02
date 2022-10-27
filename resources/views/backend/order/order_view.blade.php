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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <table id="category" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Created</th>
                    <th scope="col">Status</th>
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
                        <td>{{ $item['order_status'] }}</td>
                        <td style="width: 12%">
                            <a title="Order Details" href="{{route('admin.order.details', $item['id'])}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            @if($item['order_status'] == 'Shipped' || $item['order_status'] == 'Deliverd')
                            <a title="Invoice" href="{{route('order.invoice', $item['id'])}}" class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            @endif

                            <a target="_blank" title="PDF" href="{{route('order.pdf', $item['id'])}}" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf" aria-hidden="true"></i>
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
    <!-- /.content -->
</div>
        
        <!--/ wrapper -->

@endsection


