@extends('backend.admin_master')

@section('admin')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sections</li>
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
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($allData as $item)
                    <tr>
                      <td>{{$item -> id }}</td>
                      <td>{{ $item -> name }}</td>
                      <td>
                        @if($item -> status == 1)
                        <a class="sectionActiveInactive text-success" id="section-{{$item -> id}}" section_id="{{ $item -> id }}" href="javascript:void(0)">Active</a>
                        @else 
                        <a class="sectionActiveInactive text-danger" id="section-{{$item -> id}}"  section_id="{{ $item -> id }}" href="javascript:void(0)">Inactive</a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SR</th>
                    <th>Name</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
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