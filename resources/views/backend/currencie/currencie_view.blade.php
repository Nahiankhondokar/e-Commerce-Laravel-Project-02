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
              <li class="breadcrumb-item active">Currencie</li>
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
                <h3 class="card-title">All Currencie</h3>
                <a href="{{ route('currencie.add.edit') }}" class="btn btn-info float-right">Add Currencie</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR</th>
                    <th>Currencie Code</th>
                    <th>Currencie Rate</th>
                    <th>Status</th>
                    <th>Action</th>
                    {{-- <th>Action</th> --}}

                  </tr>
                  </thead>
                  <tbody id="">
                    @foreach($allCurrencie as $key => $item)
                    <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $item -> currnecie_code }}</td>
                     <td>{{ $item -> currnecie_rate }}</td>
                     <td>
                        @if($item -> status == 1)
                        <div class="currencieAtiveInactive" id="currencie-{{$item -> id}}" currencie_id="{{$item -> id}}">
                            <a id="currencie_active-btn-{{$item -> id}}" class="badge badge-success"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                        </div>
                        @else 
                        <div class="currencieAtiveInactive" id="currencie-{{$item -> id}}" currencie_id="{{$item -> id}}">
                            <a id="currencie_active-btn-{{$item -> id}}" class="badge badge-danger"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
                        </div>
                        @endif

                    </td>
                     <td>
                         <a title="Edit" href="{{ route('currencie.add.edit', $item -> id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                         
                         <a title="Delete" id="delete" href="{{ route('currencie.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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