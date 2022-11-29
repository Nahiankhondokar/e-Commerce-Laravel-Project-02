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
              <li class="breadcrumb-item active">Coupon</li>
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
                <h3 class="card-title">All Coupon</h3>
                <a href="{{ route('coupon.edit.add') }}" class="btn btn-info float-right">Add Coupon</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Coupon Option</th>
                    <th>Coupon Type</th>
                    <th>Amount</th>
                    <th>Users</th>
                    <th>Expire Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="">
                   @foreach($coupon as $key => $item)
                   <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item -> coupon_option }}</td>
                      <td>{{ $item -> coupon_type }}</td>
                      <td>{{ $item -> amount }}
                          @if($item -> amount_type == 'Percentage')
                          %
                          @else
                          $
                          @endif
                      </td>
                      <td>{{ $item -> users }}</td>
                      <td>{{ $item -> expire_date }}</td>
                      <td>
                        @if($couponModule['edit_access'] == 1 || $couponModule['full_access'] == 1)
                          @if($item -> status == 1)
                          <div class="couponActiveInactive" id="coupon-{{$item -> id}}" coupon_id="{{$item -> id}}">
                              <a id="coupon_active-btn-{{$item -> id}}" class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                          </div>
                          @else 
                          <div class="couponActiveInactive" id="coupon-{{$item -> id}}" coupon_id="{{$item -> id}}">
                              <a id="coupon_active-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                          </div>
                          @endif
                        @else 
                          <span style="color: red">No Access</span>
                        @endif
                      </td>
                      <td>
                        @if($couponModule['edit_access'] == 1 || $couponModule['full_access'] == 1)
                          <a title="Edit" href="{{ route('coupon.edit.add', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                          
                          @if($couponModule['full_access'] == 1)
                            <a title="Delete" id="delete" href="{{ route('coupon.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          @endif
                        @else 
                          <span style="color: red">No Access</span>
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