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
              <li class="breadcrumb-item active">User</li>
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
                <h3 class="card-title">All Product User</h3>
                <button type="button" class="btn btn-info float-right" >Add User</button> &nbsp; &nbsp;
                <a href="{{ route('user.report') }}" class="btn btn-primary float-right">User Reports</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="dataTable">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Status</th>
                    {{-- <th>Action</th> --}}

                  </tr>
                  </thead>
                  <tbody id="">
                    @foreach($users as $key => $item)
                    <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $item -> name }}</td>
                     <td>{{ $item -> email }}</td>
                     <td>{{ $item -> phone }}</td>
                     <td>{{ $item -> address }}</td>
                     <td>{{ $item -> city }}</td>
                     <td>{{ $item -> country }}</td>
                     <td>{{ $item -> pincode }}</td>
                     <td>
                         @if($item -> status == 1)
                         <div class="userActiveInactive" id="user-{{$item -> id}}" user_id="{{$item -> id}}">
                             <a id="user_active-btn-{{$item -> id}}" class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                         </div>
                         @else 
                         <div class="userActiveInactive" id="user-{{$item -> id}}" user_id="{{$item -> id}}">
                             <a id="user_active-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                         </div>
                         @endif
 
                     </td>
                     {{-- <td>
                         <a title="Edit" href="{{ route('coupon.edit.add', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                         
                         <a title="Delete" id="delete" href="{{ route('coupon.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                       </td>
                   </tr> --}}
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