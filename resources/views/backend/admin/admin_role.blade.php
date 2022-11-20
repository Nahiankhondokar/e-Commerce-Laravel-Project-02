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
              <li class="breadcrumb-item active">Admin or SubAdmin</li>
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
                <h3 class="card-title">All Admin or SubAdmin</h3>
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#productBrandAdd">Add Admin Role</button>
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
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                    {{-- <th>Action</th> --}}

                  </tr>
                  </thead>
                  <tbody id="">
                    @foreach($allAdmin as $key => $item)
                    <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $item -> name }}</td>
                     <td>{{ $item -> email }}</td>
                     <td>{{ $item -> phone }}</td>
                     <td>{{ $item -> type }}</td>
                     <td>
                         @if($item -> status == 1)
                         <div class="AdminActiveInactive" id="admin-{{$item -> id}}" admin_id="{{$item -> id}}">
                             <a id="admin_active-btn-{{$item -> id}}" class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                         </div>
                         @else 
                         <div class="AdminActiveInactive" id="admin-{{$item -> id}}" admin_id="{{$item -> id}}">
                             <a id="admin_active-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                         </div>
                         @endif
 
                     </td>
                     <td>
                         <a title="Edit" href="{{ route('coupon.edit.add', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                         
                         <a title="Delete" id="delete" href="{{ route('coupon.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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