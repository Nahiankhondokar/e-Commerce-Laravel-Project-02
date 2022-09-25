@extends('backend.admin_master')

@section('admin')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title">All Sections</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="section" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($allData as $item)
                    <tr>
                      <td>{{ $item -> id }}</td>
                      <td>{{ $item -> category_name }}</td>
                      <td>{{ $item -> url }}</td>
                      <td>
                        @if($item -> status == 1)
                        <div class="categoryActiveInactive" id="category-{{$item -> id}}" category_id="{{ $item -> id }}">
                          <a id="cat_active-btn-{{$item -> id}}" class="badge badge-success" href="javascript:void(0)">Active</a>
                        </div>
                        @else 
                        <div class="categoryActiveInactive" id="category-{{$item -> id}}" category_id="{{ $item -> id }}">
                          <a id="cat_inactive-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)">Inactive</a>
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