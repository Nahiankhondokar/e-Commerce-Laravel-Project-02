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
                <h3 class="card-title">All Category</h3>
                <a href="{{ route('category.add.view') }}" class="btn btn-info float-right">Add Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="category" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Section</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($allData as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ ucwords($item -> category_name) }}</td>
                      <td>{{ ucwords($item -> parentCategory -> category_name ?? 'Root') }}</td>
                      <td>{{ ucwords($item -> section -> name) }}</td>
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

                        <td>
                          <a href="{{ route('category.edit', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                          <a id="delete" href="{{ route('category.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
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