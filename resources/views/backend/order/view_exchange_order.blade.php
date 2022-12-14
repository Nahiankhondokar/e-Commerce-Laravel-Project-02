@extends('backend.admin_master')

@section('admin')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invertory Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rating & Review</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Exchange Request</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>User id</th>
                    <th>Order id</th>
                    <th>Product size</th>
                    <th>Required size</th>
                    <th>Product Code</th>
                    <th>Exchange Reason</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Exchange Status</th>
                    <th>Approve/Reject</th>
                  </tr>
                  </thead>
                  <tbody id="">
                   @foreach($exchange_product as $key => $item)
                   <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item -> user_id}}</td>
                        <td>{{ $item -> order_id }}</td>
                        <td>{{ $item -> product_size }}</td>
                        <td>{{ $item -> required_size }}</td>
                        <td>{{ $item -> product_code }}</td>
                        <td>{{ $item -> exchange_reason }}</td>
                        <td>{{ $item -> comment }}</td>
                        <td>{{ date('d-m-Y', strtotime($item -> created_at)) }}</td>
                        <td><p class="badge badge-warning ExchangeRequestUpdate-{{$item -> id}}">{{ $item -> exchange_status }}</p></td>
                        <td>
                            <a href="{{route('exchange.request.approved', $item -> id)}}" class="badge badge-success ExchangeRequestInfo">Approved</a>

                            <a href="{{route('exchange.request.reject', $item -> id)}}" class="badge badge-danger ExchangeRequestInfo">Rejected</a>
                            
                        </td>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



@endsection