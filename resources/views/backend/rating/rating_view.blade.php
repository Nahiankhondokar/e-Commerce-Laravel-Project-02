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
                <h3 class="card-title">All Rating & Review</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody id="">
                   @foreach($ratings as $key => $item)
                   <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item -> getUser -> name }}</td>
                        <td>{{ $item -> getProduct -> product_name }}</td>
                        <td>{{ $item -> review }}</td>
                        <td>{{ $item -> rating }}</td>
                        <td>
                            @if($item -> status == 1)
                            <div class="ratingActiveInactive" id="rating-{{$item -> id}}" rating_id="{{$item -> id}}">
                                <a id="rating_active-btn-{{$item -> id}}" class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                            </div>
                            @else 
                            <div class="ratingActiveInactive" id="rating-{{$item -> id}}" rating_id="{{$item -> id}}">
                                <a id="rating_active-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>
                            </div>
                            @endif

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